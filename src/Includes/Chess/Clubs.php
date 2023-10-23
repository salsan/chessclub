<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes\Chess;

/**
 *
 * Inizialization of services
 *
 * @package Salsan\Chessclub\Includes
 */
final class Clubs {

	static function init( $id ) {

		if ( ! is_string( $id ) ) {
			return $id;
		}

		$nation    = substr( $id, 0, 2 );
		$nation_id = substr( $id, 2 );

		switch ( $nation ) {
			case 'IT':
				return self::get_clubs_it( $nation_id );
				break;
			default:
				break;
				return;
		}
	}

	static function get_clubs_it( $id ) {
		$data         = new \Salsan\Clubs\Form();
		$current_year = max( $data->getYears() );
		$first_year   = min( $data->getYears() );

		$club      = array();
		$nation_id = 'IT' . $id;

		for ( $year = $current_year; $year >= $first_year; $year-- ) {
			$query     = new \Salsan\Clubs\Query(
				array(
					'clubId' => $id,
					'year'   => $year,
				)
			);
			$club_info = $query->getInfo();

			if ( count( $club_info ) > 0 ) {
				$members = new \Salsan\Members\Query(
					array(
						'clubId'         => $id,
						'membershipYear' => $year,
					)
				);

				$list                    = $members->getList();
				list ( $total, $rookie ) = array_values( $members->getNumber() );

				$club[ $nation_id ][ $year ] = array(
					'info'    => $club_info[ $id ],
					'members' => $list,
					'stats'   => array(
						'total'  => $total,
						'rookie' => $rookie,
					),
				);
			}
		}

		return $club;
	}
}
