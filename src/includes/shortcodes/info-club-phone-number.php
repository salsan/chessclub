<?php
/**
 * Shortcode telephone number club.
 *
 * @package Salsan/Chessclub
 */

declare(strict_types=1);

namespace Salsan\Chessclub\includes\shortcodes;

use Salsan\Clubs;

/**
 * Return total number of members of club for year.
 *
 *  @param array $atts Array contain value for query.
 *
 *  $params = [
 *      'id'   => (integer) id chess club on federation. Required.
 *      'year' => (integer)  select year of subscription. Required.
 *  ].
 *
 * @return string
 */
function shortcode_cc_info_club_phone_number( $atts ): string {

	$params = shortcode_atts(
		array(
			'id' => '',
		),
		$atts
	);

	$query = new Clubs\Query(
		array(
			'clubId' => $params['id'],
		)
	);

	return sanitize_text_field( $query->getInfo()[ $params['id'] ]['contact']['tel'] );
}
