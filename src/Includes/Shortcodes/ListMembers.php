<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes\Shortcodes;

use Salsan\Utils\String\HiddenSpaceTrait;


/**

 *  WordPress Shortcode list members of Chess Club
 *
 * @package Salsan\Chessclub\Includes\Shortcodes
 */
class ListMembers {
	use HiddenSpaceTrait;

	/**
	 *
	 * Inizilization shortcode list members of chess club.
	 *
	 * @return void  */
	public function __construct() {
		add_shortcode( 'cc_list_members', array( $this, 'shortcode_cc_list_members' ) );
	}

	/**
	 *
	 *  Shortcode list members of Chess Club
	 *
	 * @param mixed $atts years of membership.
	 * @return string
	 */
	public function shortcode_cc_list_members( $atts ): string {

		$params = shortcode_atts(
			array(
				'year' => '',
			),
			$atts
		);

		$members_list = \Salsan\Chessclub\Includes\Chess\Clubs::get_members_list( $params[ 'year' ] );

		if ( ! empty( $members_list ) ) {

			$table = '<table>
			<tr>
			  <th>Name</th>
			  <th>Category</th>
			  <th>Nation</th>
			</tr>';

			foreach ( $members_list as $id => $member ) {
				$experience = $member['isRookie'] ? 'rookie' : 'expert';

				$table .= '<tr>
							<td class=member-' . $experience . ' id=' . $id . '>' . $member['name'] . '</td>
							<td>' . $member['category'] . '</td>
							<td class=flag-' . $this->replaceWithStandardSpace( $member['citizenship'] ) . '></td>
						</tr>';
			}
		}

		$table .= '</table>';

		return ( $table );
	}
}
