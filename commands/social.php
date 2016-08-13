<?php
/**
 * Manage Front Page Settings.
 */
class Devtools_Social_Command {

	protected $arr = array(
			array(
				'menu-item-title' => 'Facebook',
				'menu-item-url'   => 'http://facebook.com/example',
			),
			array(
				'menu-item-title' => 'Twitter',
				'menu-item-url'   => 'http://twitter.com/example',
			),
			array(
				'menu-item-title' => 'Youtube',
				'menu-item-url'   => 'http://youtube.com/example',
			),
			array(
				'menu-item-title' => 'Linkedin',
				'menu-item-url'   => 'http://linkedin.com/example',
			),
			array(
				'menu-item-title' => 'Google',
				'menu-item-url'   => 'http://plus.google.com/example',
			),
			array(
				'menu-item-title' => 'Dribbble',
				'menu-item-url'   => 'http://dribbble.com/example',
			),
			array(
				'menu-item-title' => 'Pinterest',
				'menu-item-url'   => 'http://pinterest.com/example',
			),
			array(
				'menu-item-title' => 'Bitbucket',
				'menu-item-url'   => 'http://bitbucket.org/example',
			),
			array(
				'menu-item-title' => 'github',
				'menu-item-url'   => 'http://github.com/example',
			),
			array(
				'menu-item-title' => 'Codepen',
				'menu-item-url'   => 'http://codepen.io/example',
			),
			array(
				'menu-item-title' => 'Flickr',
				'menu-item-url'   => 'http://flickr.com/example',
			),
			array(
				'menu-item-title' => 'Feed',
				'menu-item-url'   => 'http://example.com/feed/',
			),
			array(
				'menu-item-title' => 'Foursquare',
				'menu-item-url'   => 'http://foursquare.com/example',
			),
			array(
				'menu-item-title' => 'Instagram',
				'menu-item-url'   => 'http://instagram.com/example',
			),
			array(
				'menu-item-title' => 'Tumblr',
				'menu-item-url'   => 'http://tumblr.com/example',
			),
			array(
				'menu-item-title' => 'Reddit',
				'menu-item-url'   => 'http://reddit.com/example',
			),
			array(
				'menu-item-title' => 'Vimeo',
				'menu-item-url'   => 'http://vimeo.com/example',
			),
			array(
				'menu-item-title' => 'Digg',
				'menu-item-url'   => 'http://digg.com/example',
			),
			array(
				'menu-item-title' => 'Twitch',
				'menu-item-url'   => 'http://twitch.tv/example',
			),
			array(
				'menu-item-title' => 'Delicious',
				'menu-item-url'   => 'http://delicious.com/example',
			),
			array(
				'menu-item-title' => 'Mail',
				'menu-item-url'   => 'mailto:info@example.com',
			),
			array(
				'menu-item-title' => 'Soundcloud',
				'menu-item-url'   => 'http://soundcloud.com/example',
			),
			array(
				'menu-item-title' => 'WordPress',
				'menu-item-url'   => 'http://wordpress.com/example',
			),
			array(
				'menu-item-title' => 'Jsfiddle',
				'menu-item-url'   => 'http://jsfiddle.net/example',
			),
			array(
				'menu-item-title' => 'Tripadvisor',
				'menu-item-url'   => 'http://tripadvisor.com/example',
			),
			array(
				'menu-item-title' => 'Foursquare',
				'menu-item-url'   => 'http://foursquare.com/example',
			),
			array(
				'menu-item-title' => 'Angel',
				'menu-item-url'   => 'http://angel.co/example',
			),
			array(
				'menu-item-title' => 'Slack',
				'menu-item-url'   => 'http://slack.com/example',
			),
		);


	/**
	 * Create a new social menu.
	 *
	 * ## OPTIONS
	 *
	 * <menu-name>
	 * : A descriptive name for the menu.
	 *
	 * [--count=<number>]
	 * : How many social icons?
	 * ---
	 * default: 5
	 * ---
	 *
	 * [--porcelain]
	 * : Output just the new menu id.
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
	public function __invoke( $args, $assoc_args ) {

		$social_menu = $this->create_social_menu( $args[0], $assoc_args );

		if ( false === $social_menu ) {

			WP_CLI::error( 'Social menu could not be created.' );

		} else {

			if ( \WP_CLI\Utils\get_flag_value( $assoc_args, 'porcelain' ) ) {
				WP_CLI::line( $social_menu );
			} else {
				WP_CLI::success( 'Social menu created successfully.' );
			}

		}

	}

	private function create_social_menu( $menu_name, $assoc_args ) {

		$menu_id = wp_create_nav_menu( $menu_name );

		if ( is_wp_error( $menu_id ) ) {
			WP_CLI::error( $menu_id->get_error_message() );
		}
		else {
			if ( $menu_id ) {
				// Add social items.
			}
		}

		return $menu_id;

	}

}

WP_CLI::add_command( 'dt social', 'Devtools_Social_Command' );
