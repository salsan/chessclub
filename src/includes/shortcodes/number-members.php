<?php
/**
 * Shortcode number of Chess Members of Club.
 *
 * @package Salsan/Chessclub
 */

declare(strict_types=1);

namespace Salsan\Chessclub\includes\shortcodes;

use Salsan\Members;

/**
 * Return total number of members of club for year.
 *
 *  @param array $atts Array contain value for query.
 *
 *  $params = [
 *      'id'   => (integer) id chess club on federation. Required.
 *      'year' => (date)  select year of subscription. Required.
 *      'type' => ('total', 'rookie') all is total members of club, rookie count only new member. Required.
 *  ].
 *
 * @return string
 */
function shortcode_cc_number_members( $atts ): string {

	$params = shortcode_atts(
		array(
			'id'   => '',
			'year' => '',
			'type' => '',
		),
		$atts
	);

	$query = new Members\Query(
		array(
			'clubId'         => $params['id'],
			'membershipYear' => $params['year'],
		)
	) ?? '0';

	return sanitize_text_field( $query->getNumber()[ $params['type'] ] );
}
