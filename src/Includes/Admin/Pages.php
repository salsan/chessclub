<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes\Admin;

/**
 *
 *  Class Pages
 *
 * @package Salsan\Chessclub\Includes\Admin */
final class Pages {
	const PLUGIN_PATH = MY_PLUGIN_PATH;

	/**
	 *
	 *  Load admin settings page
	 *
	 * @return mixed  */
	public static function page_settings() {
		return require_once self::PLUGIN_PATH . '/admin/settings.php';
	}

	/**
	 *
	 *  Add comment to settings section page
	 *
	 * @return void  */
	public static function section_settings() {
		echo 'Configure your account :';
	}

	/**
	 *
	 *  Load specific form option
	 *
	 * @return void  */
	public static function field_settings_select_club() {

		$nation = \Salsan\Chessclub\Includes\Chess\Clubs::get_nation();

		// https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2 .
		switch ( $nation ) {
			case 'IT':
				require_once self::PLUGIN_PATH . '/admin/select-club-it.php';
				break;
			default:
				require_once self::PLUGIN_PATH . '/admin/select-club-it.php';
				return;
		}
	}

	/**
	 *
	 *  Load page about
	 *
	 * @return mixed  */
	public static function page_about() {
		return require_once self::PLUGIN_PATH . '/admin/about.php';
	}
}
