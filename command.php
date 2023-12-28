<?php

namespace Nilambar\Devtools;

use WP_CLI;

if ( ! class_exists( '\WP_CLI' ) ) {
	return;
}

$devtools_autoloader = __DIR__ . '/vendor/autoload.php';

if ( file_exists( $devtools_autoloader ) ) {
	require_once $devtools_autoloader;
}

WP_CLI::add_command( 'dt home', Home_Command::class );
WP_CLI::add_command( 'dt open', Open_Command::class );
WP_CLI::add_command( 'dt social', Social_Command::class );
