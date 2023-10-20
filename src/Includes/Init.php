<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes;

/**
 *
 * Inizialization of services
 *
 * @package Salsan\Chessclub\Includes
 */
final class Init {

	/**
	 * Store all services inside an array
	 *
	 * @return array Full list of service
	 */
	public static function get_services() {
		return array(
			'Shortcodes',
			'Admin',
		);
	}

	/**
	 * Loop through the services, initialize them.
	 *
	 * @return void
	 */
	public static function init() {
		foreach ( self::get_services() as $service ) {
			if ( ! function_exists( $service ) ) {
				$class = 'Salsan\\Chessclub\\Includes\\' . $service . '\\Init';
				$class::init();
			}
		}
	}
}
