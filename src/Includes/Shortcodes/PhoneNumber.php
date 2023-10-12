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
	 * @param array $atts Array contain value for query.
	 *
	 * @return string
	 */
	public function shortcode_cc_phone_number( $atts ): string {

		$params = shortcode_atts(
			array(
				'id' => '',
			),
			$atts
		);

		$query = new \Salsan\Clubs\Query(
			array(
				'clubId' => $params['id'],
			)
		);

		return sanitize_text_field( $query->getInfo()[ $params['id'] ]['contact']['tel'] );
	}
}
