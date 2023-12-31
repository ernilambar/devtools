<?php
namespace Nilambar\Devtools;

use WP_CLI;
use WP_CLI_Command;

/**
 * Manage Front Page Settings.
 */
class Home_Command extends WP_CLI_Command {

	protected $modes = array(
		'page' => 'Static Page',
		'post' => 'Latest Posts',
	);

	/**
	 * Front page settings.
	 *
	 * ## OPTIONS
	 *
	 * <mode>
	 * : Front page mode.
	 * ---
	 * options:
	 *   - page
	 *   - post
	 * ---
	 *
	 * ## EXAMPLES
	 *
	 *     # Set front page display to latest posts.
	 *     $ wp dt home post
	 *     Success: Front page displays set to Latest Posts.
	 *
	 *     # Set front page display to static page.
	 *     $ wp dt home page
	 *     Success: Front page displays set to Static Page.
	 *
	 * @subcommand home
	 */
	public function __invoke( $args, $assoc_args ) {
		$mode = $args[0];

		if ( 'page' === $mode ) {
			$this->page_callback();
		} elseif ( 'post' === $mode ) {
			$this->post_callback();
		}
	}

	/**
	 * Set front page display to latest posts.
	 */
	private function post_callback() {
		$response = WP_CLI::launch_self( 'option set', array( 'show_on_front', 'posts' ), array(), false, true );
		$response = WP_CLI::launch_self( 'option set', array( 'page_on_front', '' ), array(), false, true );
		$response = WP_CLI::launch_self( 'option set', array( 'page_for_posts', '' ), array(), false, true );

		$success_message = 'Front page displays set to %s.';

		WP_CLI::success( sprintf( $success_message, $this->modes['post'] ) );
	}

	/**
	 * Set front page display to static page.
	 */
	private function page_callback() {
		$response = WP_CLI::launch_self( 'option set', array( 'show_on_front', 'page' ), array(), false, true );

		// Check front page.
		$page_id = null;

		$response = WP_CLI::launch_self(
			'post list',
			array(),
			array(
				'post_type' => 'page',
				'name'      => 'front-page',
				'field'     => 'ID',
				'format'    => 'ids',
			),
			false,
			true
		);

		if ( absint( $response->stdout ) > 0 ) {
			$page_id = $response->stdout;
		} else {
			// Create page.
			$page_content = "Use this static Page to test the Theme's handling of the Front Page template file.

				This is the Front Page content. Use this static Page to test the Front Page output of the Theme. The Theme should properly handle both Blog Posts Index as Front Page and static Page as Front Page.

				If the site is set to display the Blog Posts Index as the Front Page, then this text should not be visible. If the site is set to display a static Page as the Front Page, then this text may or may not be visible. If the Theme does not include a front-page.php template file, then this text should appear on the Front Page when set to display a static Page. If the Theme does include a front-page.php template file, then this text may or may not appear.";

			$resp = WP_CLI::launch_self(
				'post create',
				array(),
				array(
					'post_title'   => 'Front Page',
					'post_content' => $page_content,
					'post_type'    => 'page',
					'post_status'  => 'publish',
					'porcelain'    => true,
				),
				false,
				true
			);

			$page_id = $resp->stdout;
		}

		if ( absint( $page_id ) > 0 ) {
			$response = WP_CLI::launch_self( 'option set', array( 'page_on_front', $page_id ), array(), false, true );
		}

		// Check blog page.
		$page_id = null;

		$response = WP_CLI::launch_self(
			'post list',
			array(),
			array(
				'post_type' => 'page',
				'name'      => 'blog',
				'field'     => 'ID',
				'format'    => 'ids',
			),
			false,
			true
		);

		if ( absint( $response->stdout ) > 0 ) {
			$page_id = $response->stdout;
		} else {
			// Create page.
			$page_content = "Use this static Page to test the Theme's handling of the Blog Posts Index page. If the site is set to display a static Page on the Front Page, and this Page is set to display the Blog Posts Index, then this text should not appear.";

			$resp = WP_CLI::launch_self(
				'post create',
				array(),
				array(
					'post_title'   => 'Blog',
					'post_content' => $page_content,
					'post_type'    => 'page',
					'post_status'  => 'publish',
					'porcelain'    => true,
				),
				false,
				true
			);

			$page_id = $resp->stdout;
		}

		if ( absint( $page_id ) > 0 ) {
			$response = WP_CLI::launch_self( 'option set', array( 'page_for_posts', $page_id ), array(), false, true );
		}

		$success_message = 'Front page displays set to %s.';
		WP_CLI::success( sprintf( $success_message, $this->modes['page'] ) );
	}
}
