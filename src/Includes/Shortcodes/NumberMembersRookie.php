<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes\Shortcodes;

/**
 *  WordPress Shortcode count number of rookie members of club.
 *
 * @package Salsan\Chessclub\Includes\Shortcodes
 */
class NumberMembersRookie {
	/**
	 *
	 * Inizilization shortcode count number of rookie members on Chess Club.
	 *
	 * @return void  */
	public function __construct() {
		add_shortcode( 'cc_number_members_rookie', array( $this, 'shortcode_cc_number_members_rookie' ) );
	}
	/**
	 * Shortcode rookie number of members of club for year.
	 *
	 * @param array $atts Array contain value for query.
	 *
	 *  $params = [
	 *      'year' => (integer) year of membership. Optional.
	 * ].
	 *
	 * @return string
	 */
	public function shortcode_cc_number_members_rookie( $atts ): string {
		$rookie = '';

		$params = shortcode_atts(
			array(
				'year' => '',
			),
			$atts
		);

		$rookie = \Salsan\Chessclub\Includes\Chess\Clubs::get_number_members( $params['year'] )['rookie'] ?? '';

		return sanitize_text_field( $rookie );
	}
}
