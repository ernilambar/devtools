<?php
/**
 * Manage Image.
 */
class Devtools_Image_Command {

	/**
	 * Image info.
	 *
	 * ## EXAMPLES
	 *
	 *     # Set front page display to latest posts.
	 *     $ wp dt front post
	 *     Success: Front page displays set to Latest Posts.
	 *
	 *     # Set front page display to static page.
	 *     $ wp dt front page
	 *     Success: Front page displays set to Static Page.
	 */
	public function info( $args, $assoc_args ) {

		print_r( 'Image info here' );

	}

}

WP_CLI::add_command( 'dt image', 'Devtools_Image_Command' );
