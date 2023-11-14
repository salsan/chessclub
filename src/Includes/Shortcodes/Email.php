<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes\Shortcodes;

/**
 *  WordPress Shortcode for Chess Club
 *
 * @package Salsan\Chessclub\Includes\Shortcodes
 */
class Email {
	/**
	 * Inizilization shortcode email club.
	 *
	 * @return void  */
	public function __construct() {
		add_shortcode( 'cc_email', array( $this, 'shortcode_cc_email' ) );
	}
	/**
	 *  Shortcode email club.
	 *
	 * @param mixed $atts shortcode attributes.
	 * @return string
	 */
	public function shortcode_cc_email( $atts ): string {

		$params = shortcode_atts(
			array(
				'year' => '',
			),
			$atts
		);

		$email = \Salsan\Chessclub\Includes\Chess\Clubs::get_club_email( $params['year'] ) ?? '';

		return sanitize_text_field( $email );
	}
}
