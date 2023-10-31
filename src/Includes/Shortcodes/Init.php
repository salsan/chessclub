<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes\Shortcodes;

/**
 *
 * Inizialization of shortcodes
 *
 * @package Salsan\Chessclub\Includes\Shortcodes
 */
final class Init {

	/**
	 * Store all shortcode inside an array
	 *
	 * @return array Full list of shortcode
	 */
	public static function get_shortcodes() {
		return array(
			NumberMembers::class,
			NumberMembersTotal::class,
			NumberMembersRookie::class,
			PhoneNumber::class,
			Website::class,
			ListMembers::class
		);
	}

	/**
	 * Loop through the shortcodes, initialize them.
	 *
	 * @return void
	 */
	public static function init() {
		foreach ( self::get_shortcodes() as $shortcode ) {
			new $shortcode();
		}
	}
}
