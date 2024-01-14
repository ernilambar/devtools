<?php
namespace Nilambar\Devtools;

use WP_CLI;
use WP_CLI_Command;

class Social_Command extends WP_CLI_Command {

	protected $socials = array(
		array(
			'menu-item-title' => 'Facebook',
			'menu-item-url'   => 'https://facebook.com/example',
		),
		array(
			'menu-item-title' => 'Twitter',
			'menu-item-url'   => 'https://twitter.com/example',
		),
		array(
			'menu-item-title' => 'Youtube',
			'menu-item-url'   => 'https://youtube.com/example',
		),
		array(
			'menu-item-title' => 'Linkedin',
			'menu-item-url'   => 'https://linkedin.com/example',
		),
		array(
			'menu-item-title' => 'Google',
			'menu-item-url'   => 'https://plus.google.com/example',
		),
		array(
			'menu-item-title' => 'Dribbble',
			'menu-item-url'   => 'https://dribbble.com/example',
		),
		array(
			'menu-item-title' => 'Pinterest',
			'menu-item-url'   => 'https://pinterest.com/example',
		),
		array(
			'menu-item-title' => 'Bitbucket',
			'menu-item-url'   => 'https://bitbucket.org/example',
		),
		array(
			'menu-item-title' => 'github',
			'menu-item-url'   => 'https://github.com/example',
		),
		array(
			'menu-item-title' => 'Codepen',
			'menu-item-url'   => 'https://codepen.io/example',
		),
		array(
			'menu-item-title' => 'Flickr',
			'menu-item-url'   => 'https://flickr.com/example',
		),
		array(
			'menu-item-title' => 'Feed',
			'menu-item-url'   => 'https://example.com/feed/',
		),
		array(
			'menu-item-title' => 'Foursquare',
			'menu-item-url'   => 'https://foursquare.com/example',
		),
		array(
			'menu-item-title' => 'Instagram',
			'menu-item-url'   => 'https://instagram.com/example',
		),
		array(
			'menu-item-title' => 'Tumblr',
			'menu-item-url'   => 'https://tumblr.com/example',
		),
		array(
			'menu-item-title' => 'Reddit',
			'menu-item-url'   => 'https://reddit.com/example',
		),
		array(
			'menu-item-title' => 'Vimeo',
			'menu-item-url'   => 'https://vimeo.com/example',
		),
		array(
			'menu-item-title' => 'Digg',
			'menu-item-url'   => 'https://digg.com/example',
		),
		array(
			'menu-item-title' => 'Twitch',
			'menu-item-url'   => 'https://twitch.tv/example',
		),
		array(
			'menu-item-title' => 'Delicious',
			'menu-item-url'   => 'https://delicious.com/example',
		),
		array(
			'menu-item-title' => 'Mail',
			'menu-item-url'   => 'mailto:info@example.com',
		),
		array(
			'menu-item-title' => 'Soundcloud',
			'menu-item-url'   => 'https://soundcloud.com/example',
		),
		array(
			'menu-item-title' => 'WordPress',
			'menu-item-url'   => 'https://wordpress.com/example',
		),
		array(
			'menu-item-title' => 'Jsfiddle',
			'menu-item-url'   => 'https://jsfiddle.net/example',
		),
		array(
			'menu-item-title' => 'Tripadvisor',
			'menu-item-url'   => 'https://tripadvisor.com/example',
		),
		array(
			'menu-item-title' => 'Foursquare',
			'menu-item-url'   => 'https://foursquare.com/example',
		),
		array(
			'menu-item-title' => 'Angel',
			'menu-item-url'   => 'https://angel.co/example',
		),
		array(
			'menu-item-title' => 'Slack',
			'menu-item-url'   => 'https://slack.com/example',
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
	 *     # Create social menu.
	 *     $ wp dt social "My Social Menu"
	 *     Success: Created menu 202.
	 *
	 * @subcommand social
	 */
	public function __invoke( $args, $assoc_args ) {
		$social_menu = $this->create_social_menu( $args[0], $assoc_args );

		if ( ! is_wp_error( $social_menu ) ) {

			if ( WP_CLI\Utils\get_flag_value( $assoc_args, 'porcelain' ) ) {
				WP_CLI::line( $social_menu );
			} else {
				WP_CLI::success( sprintf( 'Created menu %d.', absint( $social_menu ) ) );
			}
		}
	}

	private function create_social_menu( $menu_name, $assoc_args ) {
		$menu_id = wp_create_nav_menu( $menu_name );

		if ( is_wp_error( $menu_id ) ) {
			WP_CLI::error( $menu_id->get_error_message() );
		} else {
			$total = count( $this->socials );
			$count = absint( $assoc_args['count'] );

			for ( $i = 0; $i < $total; $i++ ) {
				wp_update_nav_menu_item(
					$menu_id,
					0,
					array(
						'menu-item-title'  => $this->socials[ $i ]['menu-item-title'],
						'menu-item-url'    => $this->socials[ $i ]['menu-item-url'],
						'menu-item-status' => 'publish',
					)
				);

				if ( ( $count - 1 ) === $i ) {
					break;
				}
			}
		}

		return $menu_id;
	}
}
