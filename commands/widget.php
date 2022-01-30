<?php
/**
 * Manage Widget.
 */
class Devtools_Widget_Command {

	/**
	 * Duplicate widget.
	 *
	 * ## OPTIONS
	 *
	 * <widget-id>
	 * : Widget ID to duplicate.
	 *
	 * ## EXAMPLES
	 *
	 *     # Duplicate widget.
	 *     $ wp dt widget duplicate text-2
	 *     Success: Widget duplicated to 'text-3'.
	 */
	public function duplicate( $args, $assoc_args ) {
		$widget_id = $args[0];

		$this->validate_sidebar_widget( $widget_id );

		list( $name, $option_index, $sidebar_id, $sidebar_index ) = $this->get_widget_data( $widget_id );
		$widget_options = $option_keys = $this->get_widget_options( $name );
		$source_options = $widget_options[ $option_index ];

		if ( ! isset( $widget_options['_multiwidget'] ) ) {
			$widget_options['_multiwidget'] = 1;
		}
		unset( $option_keys['_multiwidget'] );
		$option_keys  = array_keys( $option_keys );
		$last_key     = array_pop( $option_keys );
		$option_index = $last_key + 1;

		$widget_options[ $option_index ] = $this->sanitize_widget_options( $name, $source_options, array() );

		$this->update_widget_options( $name, $widget_options );

		$widget_id = $name . '-' . $option_index;
		$this->move_sidebar_widget( $widget_id, null, $sidebar_id, null, $sidebar_index + 1 );

		WP_CLI::success( sprintf( "Widget duplicated to '%s'.", $widget_id ) );
	}

	/**
	 * Clean up a widget's options based on its update callback
	 *
	 * @param string $id_base Name of the widget
	 * @param mixed  $dirty_options
	 * @param mixed  $old_options
	 * @return mixed
	 */
	private function sanitize_widget_options( $id_base, $dirty_options, $old_options ) {
		$widget = $this->get_widget_obj( $id_base );

		if ( empty( $widget ) ) {
			return array();
		}

		// No easy way to determine expected array keys for $dirty_options
		// because Widget API dependent on the form fields
		return @$widget->update( $dirty_options, $old_options );
	}


	/**
	 * Get the options for a given widget
	 *
	 * @param string $name
	 * @return array
	 */
	private function get_widget_options( $name ) {
		return get_option( 'widget_' . $name, array() );
	}

	/**
	 * Update the options for a given widget
	 *
	 * @param string $name
	 * @param mixed
	 */
	private function update_widget_options( $name, $value ) {
		update_option( 'widget_' . $name, $value );
	}

	/**
	 * Get a widget's instantiated object based on its name
	 *
	 * @param string $id_base Name of the widget
	 * @return WP_Widget|false
	 */
	private function get_widget_obj( $id_base ) {
		global $wp_widget_factory;

		$widget = wp_filter_object_list( $wp_widget_factory->widgets, array( 'id_base' => $id_base ) );

		if ( empty( $widget ) ) {
			false;
		}

		return array_pop( $widget );
	}

	/**
	 * Reposition a widget within a sidebar or move to another sidebar.
	 *
	 * @param string      $widget_id
	 * @param string|null $current_sidebar_id
	 * @param string      $new_sidebar_id
	 * @param int|null    $current_index
	 * @param int         $new_index
	 */
	private function move_sidebar_widget( $widget_id, $current_sidebar_id, $new_sidebar_id, $current_index, $new_index ) {
		$all_widgets = $this->wp_get_sidebars_widgets();

		$needs_placement = true;
		// Existing widget.
		if ( $current_sidebar_id && ! is_null( $current_index ) ) {

			$widgets = $all_widgets[ $current_sidebar_id ];
			if ( $current_sidebar_id !== $new_sidebar_id ) {

				unset( $widgets[ $current_index ] );

			} else {

				$part = array_splice( $widgets, $current_index, 1 );
				array_splice( $widgets, $new_index, 0, $part );

				$needs_placement = false;

			}

			$all_widgets[ $current_sidebar_id ] = array_values( $widgets );
		}

		if ( $needs_placement ) {
			$widgets = ! empty( $all_widgets[ $new_sidebar_id ] ) ? $all_widgets[ $new_sidebar_id ] : array();
			$before  = array_slice( $widgets, 0, $new_index, true );
			$after   = array_slice( $widgets, $new_index, count( $widgets ), true );
			$widgets = array_merge( $before, array( $widget_id ), $after );

			$all_widgets[ $new_sidebar_id ] = array_values( $widgets );
		}

		update_option( 'sidebars_widgets', $all_widgets );
	}

	/**
	 * Check whether the specified widget is on the sidebar.
	 *
	 * @param string $widget_id
	 */
	private function validate_sidebar_widget( $widget_id ) {
		$sidebars_widgets = $this->wp_get_sidebars_widgets();

		$widget_exists = false;

		foreach ( $sidebars_widgets as $sidebar_id => $widgets ) {

			if ( in_array( $widget_id, $widgets ) ) {
				$widget_exists = true;
				break;
			}
		}

		if ( false === $widget_exists ) {
			WP_CLI::error( sprintf( "Invalid widget '%s'.", $widget_id ) );
		}
	}

	/**
	 * Re-implementation of wp_get_sidebars_widgets()
	 * because the original has a nasty global component
	 */
	private function wp_get_sidebars_widgets() {
		$sidebars_widgets = get_option( 'sidebars_widgets', array() );

		if ( is_array( $sidebars_widgets ) && isset( $sidebars_widgets['array_version'] ) ) {
			unset( $sidebars_widgets['array_version'] );
		}

		return $sidebars_widgets;
	}

	/**
	 * Get the widget's name, option index, sidebar, and sidebar index from its ID
	 *
	 * @param string $widget_id
	 * @return array
	 */
	private function get_widget_data( $widget_id ) {
		$parts        = explode( '-', $widget_id );
		$option_index = array_pop( $parts );
		$name         = implode( '-', $parts );

		$sidebar_id    = false;
		$sidebar_index = false;

		$all_widgets = $this->wp_get_sidebars_widgets();

		foreach ( $all_widgets as $s_id => &$widgets ) {
			if ( false !== ( $key = array_search( $widget_id, $widgets ) ) ) {
				$sidebar_id    = $s_id;
				$sidebar_index = $key;
				break;
			}
		}

		return array( $name, $option_index, $sidebar_id, $sidebar_index );
	}

	/**
	 * Add test widgets.
	 *
	 * ## EXAMPLES
	 *
	 *     # Add test widgets in each sidebar.
	 *     $ wp dt widget test
	 *     Success: Test widgets added successfully.
	 */
	public function test( $args, $assoc_args ) {
		global $wp_registered_sidebars;

		$sidebars = $wp_registered_sidebars;

		if ( isset( $sidebars['wp_inactive_widgets'] ) ) {
			unset( $sidebars['wp_inactive_widgets'] );
		}

		if ( empty( $sidebars ) ) {
			WP_CLI::error( 'No sidebar registered.' );
		}

		foreach ( $sidebars as $key => $value ) {
			$widget_title       = 'Sidebar: ' . $key;
			$widget_description = sprintf( "<p>This is '%s' sidebar.</p>", $key );

			$response = WP_CLI::launch_self(
				'widget add',
				array( 'text', $key ),
				array(
					'title' => $widget_title,
					'text'  => $widget_description,
				),
				false,
				true
			);
		}

		WP_CLI::success( 'Test widgets added successfully.' );
	}
}

WP_CLI::add_command( 'dt widget', 'Devtools_Widget_Command' );
