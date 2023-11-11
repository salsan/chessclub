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
	 * @param mixed $param
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
	 * @param mixed $param
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
