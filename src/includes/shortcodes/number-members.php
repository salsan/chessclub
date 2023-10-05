<?php
/**
 * Shortcode Chess Members of Club.
 *
 * @package ChessClub
 */

declare(strict_types=1);

namespace chessclub\includes\shortcodes;

use Salsan\Members;

/**
 * Return total number of members of club for year.
 *
 *  @param array $atts Array contain value for query.
 *
 *  $params = [
 *      'id'   => (integer) id chess club on federation. Required.
 *      'anno' => (date)  select year of subscription. Required.
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
	);

	return sanitize_text_field( $query->getNumber()[ $params['type'] ] );
}
