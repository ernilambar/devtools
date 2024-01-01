<?php
namespace Nilambar\Devtools;

use WP_CLI;
use WP_CLI_Command;

/**
 * Manage Homepage Settings.
 */
class Home_Command extends WP_CLI_Command {

	protected $modes = array(
		'page' => 'Static Page',
		'post' => 'Latest Posts',
	);

	/**
	 * Homepage settings.
	 *
	 * ## OPTIONS
	 *
	 * <mode>
	 * : Homepage mode.
	 * ---
	 * options:
	 *   - page
	 *   - post
	 * ---
	 *
	 * ## EXAMPLES
	 *
	 *     # Set homepage display to latest posts.
	 *     $ wp dt home post
	 *     Success: Homepage displays set to Latest Posts.
	 *
	 *     # Set homepage display to static page.
	 *     $ wp dt home page
	 *     Success: Homepage displays set to Static Page.
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
	 * Set homepage displays to Latest Posts.
	 */
	private function post_callback() {
		update_option( 'show_on_front', 'posts' );
		update_option( 'page_on_front', '' );
		update_option( 'page_for_posts', '' );

		WP_CLI::success( sprintf( 'Homepage displays set to %s.', $this->modes['post'] ) );
	}

	private function get_page_id( $type ) {
		$page_id = 0;

		if ( 'front' === $type ) {
			$page_id = $this->get_post_by_slug( 'front-page', 'page' );

			if ( 0 === absint( $page_id ) ) {
				$page_id = $this->create_page( 'front' );
			}
		} elseif ( 'blog' === $type ) {
			$page_id = $this->get_post_by_slug( 'blog', 'page' );

			if ( 0 === absint( $page_id ) ) {
				$page_id = $this->create_page( 'blog' );
			}
		}

		return $page_id;
	}

	protected function create_page( $type ) {
		$new_id = 0;

		if ( 'front' === $type ) {
			$post_title   = 'Front Page';
			$post_content = "Use this static Page to test the Theme's handling of the Front Page template file.

			This is the Front Page content. Use this static Page to test the Front Page output of the Theme. The Theme should properly handle both Blog Posts Index as Front Page and static Page as Front Page.

			If the site is set to display the Blog Posts Index as the Front Page, then this text should not be visible. If the site is set to display a static Page as the Front Page, then this text may or may not be visible. If the Theme does not include a front-page.php template file, then this text should appear on the Front Page when set to display a static Page. If the Theme does include a front-page.php template file, then this text may or may not appear.";
		} elseif ( 'blog' === $type ) {
			$post_title   = 'Blog';
			$post_content = "Use this static Page to test the Theme's handling of the Blog Posts Index page. If the site is set to display a static Page on the Front Page, and this Page is set to display the Blog Posts Index, then this text should not appear.";
		}

		$post_arr = array(
			'post_title'   => $post_title,
			'post_content' => $post_content,
			'post_status'  => 'publish',
			'post_type'    => 'page',
		);

		$id = wp_insert_post( $post_arr );

		if ( 0 !== absint( $id ) ) {
			$new_id = $id;
		}

		return $new_id;
	}

	/**
	 * Set homepage displays to Static Page.
	 */
	private function page_callback() {
		$front_page_id = $this->get_page_id( 'front' );
		$blog_page_id  = $this->get_page_id( 'blog' );

		if ( $front_page_id && $blog_page_id ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $front_page_id );
			update_option( 'page_for_posts', $blog_page_id );

			WP_CLI::success( sprintf( 'Homepage displays set to %s.', $this->modes['page'] ) );
		}
	}

	/**
	 * Return post ID by slug.
	 *
	 * @param string $slug Post slug.
	 * @param string $post_type Post type slug.
	 * @return int Post ID.
	 */
	protected function get_post_by_slug( $slug, $post_type ) {
		$post_id = 0;

		$qargs = array(
			'post_type'      => $post_type,
			'post_status'    => 'publish',
			'pagename'       => $slug,
			'posts_per_page' => 1,
			'no_found_rows'  => true,
			'fields'         => 'ids',
		);

		$all_posts = get_posts( $qargs );

		if ( is_array( $all_posts ) && count( $all_posts ) > 0 ) {
			$post_id = reset( $all_posts );
		}

		return absint( $post_id );
	}
}
