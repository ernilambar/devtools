<?php
/**
 * Manage Image.
 */
class Devtools_Image_Command {

	private $fields = array(
		'id',
		'width',
		'height',
		'crop',
	);

	/**
	 * Image info.
	 *
	 * ## OPTIONS
	 *
	 * [--fields=<fields>]
	 * : Limit the output to specific object fields.
	 *
	 * [--format=<format>]
	 * : Render output in a particular format.
	 * ---
	 * default: table
	 * options:
	 *   - table
	 *   - csv
	 *   - json
	 *   - ids
	 *   - count
	 *   - yaml
	 * ---
	 *
	 * ## AVAILABLE FIELDS
	 *
	 * These fields will be displayed by default:
	 *
	 * * id
	 * * width
	 * * height
	 * * crop
	 *
	 * ## EXAMPLES
	 *
	 *     # List registered image sizes.
	 *     $ wp dt image info
	 *     +----------------+-------+--------+------+
	 *     | id             | width | height | crop |
	 *     +----------------+-------+--------+------+
	 *     | thumbnail      | 150   | 150    | hard |
	 *     | medium         | 300   | 300    | soft |
	 *     | large          | 1024  | 1024   | soft |
	 *     | post-thumbnail | 1200  | 9999   | soft |
	 *     +----------------+-------+--------+------+
	 */
	public function info( $args, $assoc_args ) {
		$image_info_detail = $this->get_image_info_detail();

		if ( ! empty( $assoc_args['format'] ) && 'ids' === $assoc_args['format'] ) {
			$image_info = wp_list_pluck( $image_info_detail, 'id' );
		} else {
			$image_info = $image_info_detail;
		}

		$formatter = new \WP_CLI\Formatter( $assoc_args, $this->fields );
		$formatter->display_items( $image_info );
	}

	private function get_image_info_detail() {
		$output = array();

		foreach ( array( 'thumbnail', 'medium', 'medium_large', 'large' ) as $key => $size ) {
			$item           = array();
			$item['id']     = $size;
			$item['width']  = get_option( $size . '_size_w' );
			$item['height'] = get_option( $size . '_size_h' );
			$crop           = get_option( "{$size}_crop" );
			$item['crop']   = false !== $crop ? 'hard' : 'soft';
			$output[ $key ] = $item;
		}

		$additional_sizes = wp_get_additional_image_sizes();

		if ( ! empty( $additional_sizes ) ) {
			foreach ( $additional_sizes as $key => $val ) {
				$crop           = filter_var( $val['crop'], FILTER_VALIDATE_BOOLEAN );
				$item           = array();
				$item['id']     = $key;
				$item['width']  = $val['width'];
				$item['height'] = $val['height'];
				$item['crop']   = empty( $crop ) || is_array( $val['crop'] ) ? 'soft' : 'hard';
				$output[ $key ] = $item;
			}
		}

		return $output;
	}
}

WP_CLI::add_command( 'dt image', 'Devtools_Image_Command' );
