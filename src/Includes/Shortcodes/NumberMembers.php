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
	 *      'id'   => (integer) id chess club on federation. Required.
	 *      'year' => (date)  select year of subscription. Optional.
	 *      'type' => ('total', 'rookie') all is total members of club, rookie count only new member. Required.
	 *  ].
	 *
	 * @return string
	 */
	public function shortcode_cc_number_members( $atts ): string {

		$params = shortcode_atts(
			array(
				'id'   => '',
				'year' => '',
				'type' => '',
			),
			$atts
		);

		$query = new \Salsan\Members\Query(
			array(
				'clubId'         => $params['id'],
				'membershipYear' => $params['year'],
			)
		);

		return sanitize_text_field( $query->getNumber()[ $params['type'] ] );
	}
}
