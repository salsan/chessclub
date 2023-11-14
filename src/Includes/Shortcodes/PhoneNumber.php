<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes\Shortcodes;

/**
 *  WordPress Shortcode for Chess Club
 *
 * @package Salsan\Chessclub\Includes\Shortcodes
 */
class PhoneNumber {
	/**
	 *
	 * Inizilization shortcode phone number club.
	 *
	 * @return void  */
	public function __construct() {
		add_shortcode( 'cc_phone_number', array( $this, 'shortcode_cc_phone_number' ) );
	}

	/**
	 * Shortcode telephone number club.
	 *
	 * @param mixed $atts shortcode attributes.
	 * @return string
	 */
	public function shortcode_cc_phone_number( $atts ): string {

		$params = shortcode_atts(
			array(
				'year' => '',
			),
			$atts
		);

		$phone_number = \Salsan\Chessclub\Includes\Chess\Clubs::get_club_phone_number( $params['year'] ) ?? '';

		return sanitize_text_field( $phone_number );
	}
}
