<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes;

/**
 *
 * Inizialization of services
 *
 * @package Salsan\Chessclub\Includes
 */
class Init {

	/**
	 * Store all services inside an array
	 *
	 * @return array Full list of service
	 */
	public static function get_services() {
		return array(
			'Shortcodes',
			'Admin',
			'Enqueue',
			'Widgets',
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

				$class_name = 'Salsan\\Chessclub\\Includes\\' . $service . '\\Init';

				if ( class_exists( $class_name ) ) {
					$method = new \ReflectionMethod( $class_name, 'init' );

					if ( $method->isStatic() ) {
						$class_name::init();
					} else {
						$instance = new $class_name();
						$instance->init( $class_name );
					}
				}
			}
		}
	}
}
