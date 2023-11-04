<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes\Shortcodes;

/**
 *  WordPress Shortcode for Chess Club
 *
 * @package Salsan\Chessclub\Includes\Shortcodes
 */
class ClubName {
	/**
	 * Inizilization shortcode clun name.
	 *
	 * @return void  */
	public function __construct() {
		add_shortcode( 'cc_name', array( $this, 'shortcode_cc_name' ) );
	}
	/**
	 *  Shortcode club name.
	 *
	 * @param mixed $atts shortcode attributes.
	 * @return string
	 */
	public function shortcode_cc_name( $atts ): string {

		$params = shortcode_atts(
			array(
				'year' => '',
			),
			$atts
		);

		$club_name = \Salsan\Chessclub\Includes\Chess\Clubs::get_name( $params['year'] ) ?? '';

		return sanitize_text_field( $club_name );
	}
}
