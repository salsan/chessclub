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
	 *  $params = [
	 *      'year' => (date)  select year of subscription. Optional
	 *  ].
	 *
	 * @return string
	 */
	public function shortcode_cc_phone_number( $atts ): string {

		$phone_number = '';
		$data         = get_option( 'chessclub_settings' );

		$params = shortcode_atts(
			array(
				'year' => '',
			),
			$atts
		);

		if ( false !== $data ) {
			$club_id      = array_keys( $data )['0'];
			$year         = $params['year'] ?: max( array_keys( $data[ $club_id ] ) );
			$phone_number = $data[ $club_id ][ $year ]['info']['contact']['tel'] ?? '';
		}

		return sanitize_text_field( $phone_number );
	}
}
