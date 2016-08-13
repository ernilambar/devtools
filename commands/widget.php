<?php
/**
 * Manage Widget.
 */
class Devtools_Widget_Command {

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
			$widget_title = 'Sidebar: ' . $key;
			$widget_description = sprintf( "This is '%s' sidebar.", $key );
			$response = WP_CLI::launch_self( 'widget add', array( 'text', $key ), array( 'title' => $widget_title, 'text' => $widget_description ), false, true );
		}

		WP_CLI::success( 'Test widgets added successfully.' );
	}
}

WP_CLI::add_command( 'dt widget', 'Devtools_Widget_Command' );
