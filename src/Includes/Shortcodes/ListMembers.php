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

		$members_list = '';
		$data         = get_option( 'chessclub_settings' );
		$table        = '<table>
		<tr>
		  <th>Name</th>
		  <th>Category</th>
		  <th>Nation</th>
		</tr>';

		$params = shortcode_atts(
			array(
				'year' => '',
			),
			$atts
		);

		if ( false !== $data ) {
			$club_id      = array_keys( $data )['0'];
			$year         = $params['year']
						? $params['year']
						: max( array_keys( $data[ $club_id ] ) );
			$members_list = $data[ $club_id ][ $year ]['members'];

			foreach ( $members_list as $id => $member ) {
				$experience = $member['isRookie'] ? 'rookie' : 'expert';

				$table .= '<tr>
							<td class=member-' . $experience . '>' . $member['name'] . '</td>
							<td>' . $member['category'] . '</td>
							<td class=flag-' . $this->replaceWithStandardSpace( $member['citizenship'] ) . '>' . $this->replaceWithStandardSpace( $member['citizenship'] ) . '</td>
						</tr>';
			}
		}

		$table .= '</table>';

		return ( $table );
	}
}
