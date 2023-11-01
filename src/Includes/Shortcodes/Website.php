<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes\Shortcodes;

/**
 *  WordPress Shortcode for Chess Club
 *
 * @package Salsan\Chessclub\Includes\Shortcodes
 */
class Website {
	/**
	 * Inizilization shortcode website club.
	 *
	 * @return void  */
	public function __construct() {
		add_shortcode( 'cc_website', array( $this, 'shortcode_cc_website' ) );
	}
	/**
	 *  Shortcode website club.
	 *
	 * @param mixed $atts shortcode attributes.
	 * @return string
	 */
	public function shortcode_cc_website( $atts ): string {

		$params = shortcode_atts(
			array(
				'year' => '',
			),
			$atts
		);

		$website = \Salsan\Chessclub\Includes\Chess\Clubs::get_website( $params['year'] ) ?? '';

		return sanitize_text_field( $website );
	}
}
