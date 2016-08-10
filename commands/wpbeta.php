<?php
/**
 * Manage Beta Tester.
 */
class Devtools_WPBeta_Command extends WP_CLI_Command {

	protected $modes = array(
		'point'    => 'Point release nightlies',
		'unstable' => 'Bleeding edge nightlies',
		);

	/**
	 * Set Beta Tester mode.
	 *
	 * ## OPTIONS
	 *
	 * <mode>
	 * : Beta mode; `bleeding` or `point`.
	 *
	 * ## EXAMPLES
	 *
	 *     # Set mode to bleeding edge.
	 *     $ wp dt wpbeta bleeding
	 *     Success: Mode set to 'Bleeding edge nightlies'.
	 *
	 *     # Set mode to point release.
	 *     $ wp dt wpbeta point
	 *     Success: Mode set to 'Point release nightlies'.
	 */
	public function __invoke( $args, $assoc_args ) {

		$mode = $args[0];
		if ( ! in_array( $mode, array( 'bleeding', 'point' ) ) ) {
			WP_CLI::error( 'Invalid mode.' );
		}

		$beta_tester = $this->is_beta_tester_available();
		if ( is_wp_error( $beta_tester ) ) {
			WP_CLI::error( $beta_tester );
		}

		$value = ( 'point' === $mode ) ? 'point' : 'unstable';

		WP_CLI::launch_self( 'option set', array( 'wp_beta_tester_stream', $value ), array(), false, true );

		$success_message = "Mode set to '%s'.";
		WP_CLI::success( sprintf( $success_message, $this->modes[ $value ] ) );

	}

	/**
	 * Is the requested beta tester available?
	 */
	private function is_beta_tester_available() {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';

		if ( class_exists( 'wp_beta_tester' ) ) {
			return true;
		}

		$plugins = get_plugins();
		$beta_tester = 'wordpress-beta-tester/wp-beta-tester.php';
		if ( array_key_exists( $beta_tester, $plugins ) ) {
			$error_msg = "WordPress Beta Tester needs to be activated. Try 'wp plugin activate wordpress-beta-tester'.";
		}
		else {
			$error_msg = "WordPress Beta Tester needs to be installed. Try 'wp plugin install wordpress-beta-tester --activate'.";
		}

		return new WP_Error( 'beta-tester-missing', $error_msg );
	}
}

WP_CLI::add_command( 'dt wpbeta', 'Devtools_WPBeta_Command' );
