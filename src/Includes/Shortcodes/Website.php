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
	 * @param array $atts Array contain value for query.
	 *
	 * @return void  */
	public function __construct() {
		add_shortcode( 'cc_website', array( $this, 'shortcode_cc_website' ) );
	}
	/**
	 *  Shortcode website club.
	 *
	 *  $params = [
	 *      'year' => (date)  select year of subscription. Optional
	 *  ].
	 *
	 * @return string
	 */
	public function shortcode_cc_website( $atts ): string {
		$website = '';
		$data    = get_option( 'chessclub_settings' );

		$params = shortcode_atts(
			array(
				'year' => '',
			),
			$atts
		);

		if ( false !== $date ) {
			$club_id = array_keys( $data )['0'];
			$year    = $params['year'] ?: max( array_keys( $data[ $club_id ] ) );
			$website = $data[ $club_id ][ $year ]['info']['website'] ?? '';
		}

		return sanitize_text_field( $website );
	}
}
