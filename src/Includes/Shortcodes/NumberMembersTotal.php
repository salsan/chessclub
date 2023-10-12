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
	 *      'id'   => (integer) id chess club on federation. Required.
	 *      'year' => (integer) year of membership. Required.
	 * ].
	 *
	 * @return string
	 */
	public function shortcode_cc_number_members_total( $atts ): string {

		$params = shortcode_atts(
			array(
				'id'   => '',
				'year' => '',
			),
			$atts
		);

		$result = do_shortcode( '[cc_number_members id="' . $params['id'] . '" year="' . $params['year'] . '" type="total"]' );

		return $result;
	}
}
