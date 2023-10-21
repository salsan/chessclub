<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes\Admin;

final class Pages {
	const PLUGIN_PATH = MY_PLUGIN_PATH;

	public static function page_settings() {
		return require_once self::PLUGIN_PATH . '/admin/settings.php';
	}

	public static function section_settings() {
		echo 'Configure your account :';
	}

	public static function field_settings_select_club() {

		$selected_value = ( get_option( 'chessclub_settings' ) !== false )
						? get_option( 'chessclub_settings' )
						: 'IT';

		$club_id = array_keys( $selected_value )['0'];

		$nation = substr( $club_id, 0, 2 );

		// https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2
		switch ( $nation ) {
			case 'IT':
				$list = new \Salsan\Clubs\Listing();
				require_once self::PLUGIN_PATH . '/admin/select_club_it.php';
			default:
				break;
				return;
		}
	}

	public static function page_about() {
		return require_once self::PLUGIN_PATH . '/admin/about.php';
	}
}
