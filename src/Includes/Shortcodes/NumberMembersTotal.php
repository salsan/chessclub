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
		$data = get_option( 'chessclub_settings' );

		$params = shortcode_atts(
			array(
				'year' => '',
			),
			$atts
		);

		if ( false !== $data ) {
			$club_id = array_keys( $data )['0'];
			$year    = $params['year']
					? $params['year']
					: max( array_keys( $data[ $club_id ] ) );
		}

		$result = do_shortcode( '[cc_number_members id="' . $club_id . '" year="' . $year . '" type="total"]' );

		return $result;
	}
}
