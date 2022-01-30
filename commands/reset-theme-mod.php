<?php

if ( ! class_exists( 'WP_CLI' ) ) {
	return;
}

/**
 * Reset theme mod of currently active theme.
 */
$wp_reset_theme_mod = function() {
	$option_response = WP_CLI::runcommand( 'option get stylesheet', array( 'return' => 'all' ) );

	if ( ! empty( $option_response->stdout ) ) {
		$theme_slug = trim( $option_response->stdout );

		if ( $theme_slug ) {
			$response = WP_CLI::runcommand( "option delete theme_mods_{$theme_slug}", array( 'return' => 'all' ) );
		}
	}

	WP_CLI::success( 'Theme mod reset successfully.' );
};

WP_CLI::add_command( 'dt reset-theme-mod', $wp_reset_theme_mod );
