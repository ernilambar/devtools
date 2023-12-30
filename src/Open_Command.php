<?php
namespace Nilambar\Devtools;

use WP_CLI;
use WP_CLI_Command;
use Exception;

/**
 * Manage Front Page Settings.
 */
class Open_Command extends WP_CLI_Command {

	protected $modes = array(
		'admin',
		'front',
		'customizer',
		'editor',
	);

	/**
	 * Open site URLs.
	 *
	 * ## OPTIONS
	 *
	 * <mode>
	 * : Mode `admin` or `front` or `customizer` or `editor`.
	 *
	 * ## EXAMPLES
	 *
	 *     # Open admin.
	 *     $ wp dt open admin
	 *
	 *     # Open frontend.
	 *     $ wp dt open front
	 *
	 * @subcommand open
	 *
	 */
	public function __invoke( $args, $assoc_args ) {
		$mode = $args[0];

		if ( ! in_array( $mode, $this->modes ) ) {
			WP_CLI::error( 'Invalid mode.' );
		}

		try {
			$status = $this->opener( $mode );
			if ( false === $status ) {
				WP_CLI::error( 'URL could not be opened.' );
			} else {
				WP_CLI::success( 'URL opened.' );
			}
		} catch ( Exception $error ) {
			WP_CLI::error( $error->getMessage() );
		}
	}

	/**
	 * Set front page display to latest posts.
	 */
	private function opener( $mode ) {
		switch ( strtoupper( substr( PHP_OS, 0, 3 ) ) ) {
			case 'DAR':
				$exec = 'open';
				break;
			case 'WIN':
				$exec = 'start ""';
				break;
			default:
				$exec = 'xdg-open';
		}

		$url = $this->get_url( $mode );

		passthru( $exec . ' ' . escapeshellarg( $url ) );
	}

	private function get_url( $mode ) {
		$url = '';

		switch ($mode) {
			case 'admin':
				$url = admin_url();
				break;

			case 'customizer':
				$url = admin_url( '/customize.php' );
				break;

			case 'editor':
				$url = admin_url( '/site-editor.php' );
				break;

			default:
				$url = home_url();
				break;
		}

		return $url;
	}
}
