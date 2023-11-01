<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes\Shortcodes;

/**
 *  WordPress Shortcode count number of membership on Chess Club
 *
 * @package Salsan\Chessclub\Includes\Shortcodes
 */
class NumberMembers {
	/**
	 *
	 * Inizilization shortcode count number of membership on Chess Club.
	 *
	 * @return void  */
	public function __construct() {
		add_shortcode( 'cc_number_members', array( $this, 'shortcode_cc_number_members' ) );
	}
	/**
	 *  Shortcode total number of members of club for year.
	 *
	 *  @param array $atts Array contain value for query.
	 *
	 *  $params = [
	 *      'year' => (date)  select year of subscription. Optional.
	 *      'type' => ('total', 'rookie') all is total members of club, rookie count only new member. Required.
	 *  ].
	 *
	 * @return string
	 */
	public function shortcode_cc_number_members( $atts ): string {
		$members = '';

		$params = shortcode_atts(
			array(
				'year' => '',
				'type' => '',
			),
			$atts
		);

		$members = \Salsan\Chessclub\Includes\Chess\Clubs::get_number_members( $params['year'] )[ $params['type'] ] ?? '';

		return sanitize_text_field( $members );
	}
}
