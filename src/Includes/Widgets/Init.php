<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes\Widgets;

/**
 *
 * Inizialization of widgets
 *
 * @package Salsan\Chessclub\Includes\Widgets */
class Init {

	/**
	 *
	 *
	 * Store all widgets in an array
	 *
	 * @return array-full list of widgets
	 */
	public function get_widgets() {
		return array(
			ClubAddress::class,
		);
	}

	/**
	 *
	 * Loop through widgets and register them
	 *
	 * @return void  */
	public function init() {
		foreach ( $this->get_widgets() as $widget ) {
			if ( class_exists( $widget ) && ! function_exists( $widget ) ) {
				add_action(
					'widgets_init',
					function () use ( $widget ) {
						register_widget( $widget );
					}
				);
			}
		}
	}
}
