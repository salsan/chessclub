<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}

$option_name = 'chessclub_settings';

delete_option( $option_name );
