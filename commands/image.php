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
	 * ## EXAMPLES
	 *
	 *     # List image sizes and info.
	 *     $ wp dt image info
	 *     +----------------+-------+--------+------+
	 *     | id             | width | height | crop |
	 *     +----------------+-------+--------+------+
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
