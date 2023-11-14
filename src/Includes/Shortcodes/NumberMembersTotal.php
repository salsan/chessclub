<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes\Shortcodes;

/**
 *  WordPress Shortcode count number of membership on Chess Club
 *
 * @package Salsan\Chessclub\Includes\Shortcodes
 */
class NumberMembersTotal {
	/**
	 *
	 * Inizilization shortcode count number of membership on Chess Club.
	 *
	 * @return void  */
	public function __construct() {
		add_shortcode( 'cc_number_members_total', array( $this, 'shortcode_cc_number_members_total' ) );
	}
	/**
	 * Shortcode total number of members of club for year.
	 *
	 * @param array $atts Array contain value for query.
	 *
	 *  $params = [
	 *      'year' => (integer) year of membership. Optional.
	 * ].
	 *
	 * @return string
	 */
	public function shortcode_cc_number_members_total( $atts ): string {
		$total = '';

		$params = shortcode_atts(
			array(
				'year' => '',
			),
			$atts
		);

		$total = \Salsan\Chessclub\Includes\Chess\Clubs::get_club_number_members( $params['year'] )['total'] ?? '';

		return sanitize_text_field( $total );
	}
}
