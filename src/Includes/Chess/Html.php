<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes\Chess;

use Salsan\Chessclub\Includes\Chess\Clubs;

/**
 *
 *
 * ChessClub services
 *
 * @package Salsan\Chessclub\Includes
 */
final class Html {

	/**
	 *
	 *  List of chess club
	 *
	 * @return string  */
	public static function form_option_club_it() {

		$list = new \Salsan\Clubs\Listing();

		$club_id = Clubs::get_club_id();

		$html = '';

		foreach ( $list->clubs() as $index => $club ) {
			$nation_id = 'IT' . $index;
			$selected  = ( $nation_id === $club_id ) ? 'selected' : '';

			$html .= '<option value="' . $nation_id . '" ' . $selected . '>' . $index . ' - ' . $club . '</option>';
		}

		return wp_kses(
			$html,
			array(
				'option' => array(
					'value'    => array(),
					'selected' => array(),
				),
			),
		);
	}

	/**
	 *
	 *  List Chess Federation
	 *
	 *  @return string  */
	public static function form_option_federation() {
		$federations = array(
			'FIDE' => array(
				'name' => 'FIDE	- Fédération internationale des échecs',
				'flag' => '🌐',
			),
			'IT'   => array(
				'name' => 'FSI	- Federazione Scacchistica Italiana',
				'flag' => '🇮🇹',
			),
		);

		$html = '';

		$nation = Clubs::get_nation( Clubs::get_club_id() );

		foreach ( $federations as $id => $federation ) {
			$selected = ( $nation === $id ) ? 'selected' : '';

			$html .= '<option value="' . $id . '" ' . $selected . '> ' . $federation['flag'] . ' - ' . $federation['name'] . '</option>';

		}

		return wp_kses(
			$html,
			array(
				'option' => array(
					'value'    => array(),
					'selected' => array(),
				),
			),
		);
	}
}
