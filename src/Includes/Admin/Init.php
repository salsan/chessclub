<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes\Admin;

/**
 *
 * Inizialization Admin Page
 *
 * @package Salsan\Chessclub\Includes\Shortcodes
 */
final class Init {

	/**
	 * Store all service required for Admin Page inside an array
	 *
	 * @return array Full list of menu settings
	 */
	public static function get_settings() {
		return array(
			MenuPage::class,
			SubMenuPage::class,
		);
	}

	/**
	 * Loop through the settings, initialize them.
	 *
	 * @return void
	 */
	public static function init() {
		foreach ( self::get_settings() as $setting ) {
			new $setting();
		}
	}
}
