<?php

if ( ! class_exists( 'WP_CLI' ) ) {
	return;
}

// Beta tester.
require_once 'commands/wpbeta.php';

// Front page settings.
require_once 'commands/front.php';

// Social.
require_once 'commands/social.php';

// Image.
require_once 'commands/image.php';

// Widget.
require_once 'commands/widget.php';
