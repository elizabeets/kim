<?php
/** Production */
ini_set('display_errors', 0);
define('WP_DEBUG_DISPLAY', false);
define('SCRIPT_DEBUG', false);
/** Disable all file modifications including updates and update notifications */
define('DISALLOW_FILE_MODS', true);
define( 'WP_MEMORY_LIMIT', '256M' );
define( 'WP_POST_REVISIONS', 3 );
