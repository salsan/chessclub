<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes\Chess;

/**
 *
 * ChessClub services
 *
 * @package Salsan\Chessclub\Includes
 */
final class Clubs {

	/**
	 *
	 *  Init chess club data on database
	 *
	 * @param array $id club id.
	 * @return mixed
	 */
	public static function init( $id ) {

		if ( ! is_string( $id ) ) {
			return $id;
		}

		if ( strlen( $id ) === 2 ) {
			$current_year                  = gmdate( 'Y' );
			$club                          = array();
			$club [ $id ][ $current_year ] = array();

			return $club;
		}

		$nation    = substr( $id, 0, 2 );
		$nation_id = substr( $id, 2 );

		switch ( $nation ) {
			case 'IT':
				return self::get_clubs_it( $nation_id );
			default:
				break;
		}
	}


	/**
	 *
	 *  Download data from FederScacchi.it
	 *
	 * @param mixed $id chess club id.
	 * @return array
	 */
	public static function get_clubs_it( $id ) {
		$data         = new \Salsan\Clubs\Form();
		$current_year = max( $data->getYears() );
		$first_year   = min( $data->getYears() );

		$club = array();

		if ( strlen( $id ) === 2 ) {
			return $club[ $id ][ $current_year ];
		}

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

	/**
	 *
	 * Get Federation Nation
	 *
	 * @return string  */
	public static function get_nation() {
		$nation = substr( self::get_id(), 0, 2 );

		return $nation;
	}

	/**
	 *
	 *  Get id chess club
	 *
	 * @return int|string  */
	public static function get_id() {
		$data    = self::get_data();
		$club_id = is_array( $data ) ? array_keys( $data )['0'] : '';

		return $club_id;
	}

	/**
	 *
	 *  Get data from database
	 *
	 * @return mixed  */
	public static function get_data() {
		$data = ( get_option( 'chessclub_settings' ) !== false )
		? get_option( 'chessclub_settings' )
		: '';

		return $data;
	}

	/**
	 *
	 *  Get phone number of club
	 *
	 * @param mixed $year is optional, default is current year.
	 * @return mixed
	 */
	public static function get_phone_number( $year = '' ) {
		$data         = self::get_data();
		$phone_number = '';

		if ( false !== $data ) {
			$id = self::get_id();

			$year = $year
				? $year
				: self::get_last_year();

			$phone_number = $data[ $id ][ $year ]['info']['contact']['tel'] ?? '';
		}

		return $phone_number;
	}

	/**
	 *
	 *  Get the last available year of club data
	 *
	 *  @return string  */
	public static function get_last_year() {
		$data      = self::get_data();
		$last_year = '';

		if ( false !== $data ) {
			$id        = self::get_id();
			$last_year = max( array_keys( $data[ $id ] ) );
		}
		return $last_year;
	}

	/**
	 *
	 *  Get club website.
	 *
	 *   @param mixed $year is optional, default is current year.
	 *
	 *  @return string  */
	public static function get_website( $year = '' ) {
		$data    = self::get_data();
		$website = '';

		if ( false !== $data ) {
			$club_id = self::get_id();
			$year    = $year ? $year : self::get_last_year();

			$website = $data[ $club_id ][ $year ]['info']['website'] ?? '';
		}

		return $website;
	}

	public static function get_number_members( $year = '' ) {
		$data    = self::get_data();
		$members = array();

		if ( false !== $data ) {
			$club_id = self::get_id();
			$year    = $year ? $year : self::get_last_year();
			$members = $data[ $club_id ][ $year ]['stats'] ?? '';
		}

		return $members;
	}
}
