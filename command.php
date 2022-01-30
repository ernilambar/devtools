<?php

if ( ! class_exists( 'WP_CLI' ) ) {
	return;
}

// Front page settings.
require_once 'commands/home.php';

// Social.
require_once 'commands/social.php';

// Image.
require_once 'commands/image.php';

// Widget.
require_once 'commands/widget.php';

// Admin.
require_once 'commands/admin.php';

// Front.
require_once 'commands/front.php';

// Customize.
require_once 'commands/customize.php';

// Reset theme mod.
require_once 'commands/reset-theme-mod.php';
