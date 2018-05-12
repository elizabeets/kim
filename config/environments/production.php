<?php
/** Production */
ini_set( 'display_errors', 0 );
define( 'WP_DEBUG_DISPLAY', false );
define( 'SCRIPT_DEBUG', false );
/** Disable all file modifications including updates and update notifications */
define( 'DISALLOW_FILE_MODS', true );
define( 'WP_MEMORY_LIMIT', '256M' );
define( 'WP_POST_REVISIONS', 3 );

$cloudfront_proto = $_SERVER['HTTP_CLOUDFRONT_FORWARDED_PROTO'] ?? 'http';
$server_proto     = $_SERVER['HTTP_X_FORWARDED_PROTO'] ?? 'http';

if ( $cloudfront_proto === 'https' || $server_proto === 'https' ) {
	$_SERVER['HTTPS']       = 'on';
	$_SERVER['SERVER_PORT'] = 443;
	define( 'FORCE_SSL_ADMIN', true );
	define( 'FORCE_SSL_LOGIN', true );
}
