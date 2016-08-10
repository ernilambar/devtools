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
		$value = ( 'point' === $mode ) ? 'point' : 'unstable';

		WP_CLI::launch_self( 'option set', array( 'wp_beta_tester_stream', $value ), array(), false, true );

		$success_message = "Mode set to '%s'.";
		WP_CLI::success( sprintf( $success_message, $this->modes[ $value ] ) );

	}
}

WP_CLI::add_command( 'dt wpbeta', 'Devtools_WPBeta_Command' );
