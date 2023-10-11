<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

/**
 * Shortcode number of rookie on Chess Club.
 *
 * @package Salsan/Chessclub
 */

declare(strict_types=1);

namespace Salsan\Chessclub\includes\shortcodes;

class Number_Members_Rookie {
	public function __construct() {
		add_shortcode( 'cc_number_members_rookie', array( $this, 'shortcode_cc_number_members_rookie' ) );
	}
	/**
	 * Return rookie number of members of club for year.
	 *
	 * @param array $atts Array contain value for query.
	 *
	 *  $params = [
	 *      'id'   => (integer) id chess club on federation. Required.
	 *      'year' => (integer) year of membership. Required.
	 * ].
	 *
	 * @return string
	 */
	public function shortcode_cc_number_members_rookie( $atts ): string {

		$params = shortcode_atts(
			array(
				'id'   => '',
				'year' => '',
			),
			$atts
		);

		$result = do_shortcode( '[cc_number_members id="' . $params['id'] . '" year="' . $params['year'] . '" type="rookie"]' );

		return $result;
	}
}
