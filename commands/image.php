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
	 *     | thumbnail      | 150   | 150    | 1    |
	 *     | medium         | 300   | 300    |      |
	 *     | large          | 1024  | 1024   |      |
	 *     | post-thumbnail | 1200  | 9999   |      |
	 *     +----------------+-------+--------+------+
	 */
	public function info( $args, $assoc_args ) {

		$image_info_detail = $this->get_image_info_detail();

		if ( ! empty( $assoc_args['format'] ) && 'ids' === $assoc_args['format'] ) {
			$image_info = wp_list_pluck( $image_info_detail, 'id' );
		}
		else {
			$image_info = $image_info_detail;
		}

		$formatter = new \WP_CLI\Formatter( $assoc_args, $this->fields );
		$formatter->display_items( $image_info );

	}

	private function get_image_info_detail() {

		$output = array();
		global $_wp_additional_image_sizes;

		foreach ( array( 'thumbnail', 'medium', 'large' ) as $key => $size ) {
			$item           = array();
			$item['id']     = $size;
			$item['width']  = get_option( $size . '_size_w' );
			$item['height'] = get_option( $size . '_size_h' );
			$item['crop']   = get_option( $size . '_crop' );
			$output[ $key ] = $item;
		}

		if ( ! empty( $_wp_additional_image_sizes ) ) {
			foreach ($_wp_additional_image_sizes as $key => $val ) {
				$item           = array();
				$item['id']     = $key;
				$item['width']  = $val['width'];
				$item['height'] = $val['height'];
				$item['crop']   = $val['crop'];
				$output[ $key ] = $item;
			}
		}

		return $output;

	}

}

WP_CLI::add_command( 'dt image', 'Devtools_Image_Command' );
