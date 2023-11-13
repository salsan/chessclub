<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes\Chess;

/**
 *
 * ChessClub services
 *
 * @package Salsan\Chessclub\Includes
 */
final class Fsi {
	/**
	 *
	 *  Download data from FederScacchi.it
	 *
	 * @param mixed $id chess club id.
	 * @return array
	 */
	public static function get_club( $id ) {
		if ( empty( $id ) ) {
			return;
		}

		$current_year = self::get_last_year();
		$first_year   = self::get_first_year();

		$club = array();

		if ( strlen( $id ) === 2 ) {
			return $club[ $id ][ $current_year ];
		}

		$nation_id = 'IT' . $id;

		for ( $year = $current_year; $year >= $first_year; $year-- ) {
			$params = array(
				'id'   => $id,
				'year' => $year,
			);

			$club[ $nation_id ][ $year ] = self::get_club_data( $params );
		}

		return $club;
	}

	/**
	 *
	 * Get club data from FederScacchi.it.
	 *
	 * @param mixed $params string $id , string $year.
	 * @return array
	 */
	public static function get_club_data( $params ) {
		list( 'id' => $id, 'year' => $year) = $params;

		$options = array(
			'id'   => $id,
			'year' => $year,
		);

		$club = array();

		$club_info = self::get_club_info( $options );

		if ( ! empty( $club_info ) ) {
			$members = self::get_club_members_list( $options );

			list( $total, $rookie) = array_values( self::get_club_members_stats( $options ) );

			$club = array(
				'info'    => $club_info,
				'members' => $members,
				'stats'   => array(
					'total'  => $total,
					'rookie' => $rookie,
				),
			);
		}

		return $club;
	}

		/**
		 *
		 *  Update data for italian chess club.
		 *
		 * @param mixed $options string $id , string $year.
		 * @return array
		 */
	public static function get_club_update( $options ) {
		$last_year = self::get_last_year();

		list( 'id' => $id, 'year' => $year) = $options;

		$params = array(
			'id'   => $id,
			'year' => empty( $year ) ? $last_year : $year,
		);

		$club = self::get_club_data( $params );

		return $club;
	}



	/**
	 *
	 *
	 *  Get the years data avaible.
	 *
	 * @return array  */
	public static function get_years() {
		$data  = new \Salsan\Clubs\Form();
		$years = $data->getYears();

		return $years;
	}

	/**
	 *
	 *  Get last year avaible.
	 *
	 * @return string */
	public static function get_last_year() {
		$years = self::get_years();

		$max_years = max( $years );

		return $max_years;
	}

	/**
	 *
	 * Get first year avaible.
	 *
	 * @return string  */
	public static function get_first_year() {
		$years = self::get_years();

		$min_years = min( $years );

		return $min_years;
	}

	/**
	 *
	 *  Get info about chess club.
	 *
	 * @param mixed $param string $id , string $year.
	 * @return mixed
	 */
	public static function get_club_info( $param ) {
		list( 'id' => $id, 'year' => $year) = $param;

		$query = new \Salsan\Clubs\Query(
			array(
				'clubId' => $id,
				'year'   => $year,
			)
		);

		$info = $query->getInfo()[ $id ] ?? array();

		return $info;
	}

	/**
	 *
	 * Get list of members of chess club.
	 *
	 * @param mixed $param  string $id , string $year.
	 * @return array
	 */
	public static function get_club_members_list( $param ) {
		list( 'id' => $id, 'year' => $year) = $param;
		$members                            = array();

		$query = new \Salsan\Members\Query(
			array(
				'clubId'         => $id,
				'membershipYear' => $year,
			)
		);

		foreach ( $query->getList() as $member_id => $member ) {
			$nation_id = 'IT-' . $member_id;

			$members[ $nation_id ] = array(
				'name'           => $member['name'] ?? '',
				'isRookie'       => $member['isRookie'] ?? '',
				'year_subscribe' => $member['year_subscribe'] ?? '',
				'gender'         => $member['gender'] ?? '',
				'birthday'       => $member['birthday'] ?? '',
				'category'       => $member['category'] ?? '',
				'province'       => $member['province'] ?? '',
				'region'         => $member['region'] ?? '',
				'citizenship'    => $member['citizenship'] ?? '',
				'card_number'    => $member['card_number'] ?? '',
			);
		}

		return $members;
	}

	/**
	 *
	 *  Get number of members of chess club.
	 *
	 * @param array $param  string $id  string $year .
	 * @return array
	 */
	public static function get_club_members_stats( $param ) {
		list( 'id' => $id, 'year' => $year) = $param;
		$stats                              = array();

		$query = new \Salsan\Members\Query(
			array(
				'clubId'         => $id,
				'membershipYear' => $year,
			)
		);

		$stats = $query->getNumber();

		return $stats;
	}
}
