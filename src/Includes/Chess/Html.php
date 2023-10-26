<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes\Chess;

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

		$club_id = \Salsan\Chessclub\Includes\Chess\Clubs::get_id();

		$html = '';

		foreach ( $list->clubs() as $index => $club ) {
			$nation_id = 'IT' . $index;
			$selected  = ( $nation_id === $club_id ) ? 'selected' : '';

			$html .= '<option value="' . $nation_id . '" ' . $selected . '>' . $index . ' - ' . $club . '</option>';
		}

		return $html;
	}

	public static function form_option_federation() {
		$federations = array(
			'IT' => 'Ferazione Scacchistica Italiana',
		);

		$html = '';

		$nation = \Salsan\Chessclub\Includes\Chess\Clubs::get_nation();

		foreach ( $federations as $id => $federation) {
			$selected  = ( $nation === $id ) ? 'selected' : '';

			$html .= '<option value="' . $id . '" ' . $selected . '>' . $federation . '</option>';

		}

		return $html;
	}
}
