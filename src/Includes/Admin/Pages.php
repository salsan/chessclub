<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes\Admin;

use Salsan\Chessclub\Includes\Chess\Clubs;

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
	 *  Add comment to settings section page
	 *
	 * @return void  */
	public static function nation_section() {

		echo 'Choice Federation :';
	}


	/**
	 *
	 *  Load specific form option
	 *
	 * @return void  */
	public static function field_settings_select_club() {

		$nation = Clubs::get_nation( Clubs::get_id() );

		// https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2 .

		$federation = self::PLUGIN_PATH . '/admin/select-club-' . $nation . '.php';

		if ( file_exists( $federation ) ) {
			require_once $federation;
		} else {
			require_once self::PLUGIN_PATH . '/admin/select-federation.php';
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
