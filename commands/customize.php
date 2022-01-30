<?php

if ( ! class_exists( 'WP_CLI' ) ) {
	return;
}

/**
 * Open Customizer in a browser.
 */
$wp_customize = function() {
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

	passthru( $exec . ' ' . escapeshellarg( admin_url( '/customize.php' ) ) );
};

WP_CLI::add_command( 'dt customize', $wp_customize );
