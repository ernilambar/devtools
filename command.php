<?php

if ( ! class_exists( 'WP_CLI' ) ) {
	return;
}

// Beta tester.
require_once 'commands/wpbeta.php';

// Front page settings.
require_once 'commands/front.php';
