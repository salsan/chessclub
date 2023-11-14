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
	 * @param array $options array with $id and $year.
	 * @return mixed
	 */
	public static function init( $options ) {
		$id     = $options['id'] ?? '';
		$id_old = self::get_club_id() ?? '';

		if ( empty( $id ) ) {
			return;
		}

		$nation_id  = self::get_club_nation_id( $id );
		$federation = self::get_federation( $id );
		$class_name = 'Salsan\\Chessclub\\Includes\\Chess\\' . $federation;

		// Update last year data.
		if ( $id === $id_old ) {
			$last_year    = self::get_club_last_year();
			$club [ $id ] = self::get_club();

			$options = array(
				'id'   => $nation_id,
				'year' => $last_year,
			);

			if ( class_exists( $class_name ) ) {
				$club [ $id ] [ $last_year ] = $class_name::get_club_update( $options );
			}

			return $club;
		}

		if ( empty( $nation_id ) ) {
			$last_year = self::get_club_last_year();
			return array( $id => array() );
		}

		if ( class_exists( $class_name ) ) {
			return $class_name::get_club( $nation_id );
		}
	}

	/**
	 *
	 *  Get Chess Federation
	 *
	 * @param mixed $id chess club id.
	 * @return string
	 */
	public static function get_federation( $id ) {
		$nation = self::get_nation( $id );

		$federation = array(
			'IT' => 'Fsi',
		);

		return $federation[ $nation ] ?? '';
	}

	/**
	 *
	 * Get Federation Nation
	 *
	 * @param string optional $id chess club id.
	 * @return string  */
	public static function get_nation( $id = '' ) {

		$nation = '';

		if ( ! empty( $id ) ) {
			preg_match( '/^([A-Z]{2,4})(?:-(\d+))?/', $id, $value );
			$nation = $value[1] ?? '';
		}

		return $nation;
	}


	/**
	 *
	 *  Get nation id of chess club
	 *
	 * @param string $id Optional chess club id.
	 * @return string
	 */
	public static function get_club_nation_id( $id = '' ) {
		$nation_id = '';

		if ( ! empty( $id ) ) {
			preg_match( '/^([A-Z]{2,4})-{0,1}(\d+)?/', $id, $value );
			$nation_id = $value[2] ?? '';
		}

		return $nation_id;
	}

	/**
	 *
	 *  Get id chess club
	 *
	 * @return int|string  */
	public static function get_club_id() {
		$data    = self::get_club_data();
		$club_id = ( ! empty( $data ) ) ? array_keys( $data )['0'] : '';

		return $club_id;
	}

	/**
	 *
	 *  Get data from database
	 *
	 * @return mixed  */
	public static function get_club_data() {
		$data = ( get_option( 'chessclub_settings' ) !== false )
		? get_option( 'chessclub_settings' )
		: '';

		return $data;
	}

	/**
	 *
	 *  Get name of chess club.
	 *
	 * @param string $year is optional, default is current year.
	 * @return mixed
	 */
	public static function get_club_name( $year = '' ) {
		$name = self::get_club_info( $year ) ['name'] ?? '';

		return $name;
	}

	/**
	 *
	 *  Get info about chess club.
	 *
	 * @param string $year is optional, default is current year.
	 * @return mixed
	 */
	public static function get_club_info( $year = '' ) {
		$club = self::get_club();

		$info = array();

		if ( ! empty( $club ) ) {
			$year = $year ? $year : self::get_club_last_year();

			$info = $club [ $year ]['info'] ?? '';
		}

		return $info;
	}
	/**
	 *
	 *  Get phone number of club
	 *
	 * @param mixed $year is optional, default is current year.
	 * @return mixed
	 */
	public static function get_club_phone_number( $year = '' ) {

		$phone_number = self::get_club_info( $year )['contact']['tel'] ?? '';

		return $phone_number;
	}

	/**
	 *
	 *  Get email of club.
	 *
	 * @param string $year is optional, default is current year.
	 * @return mixed
	 */
	public static function get_club_email( $year = '' ) {

		$email = self::get_club_info( $year )['contact']['email'] ?? '';

		return $email;
	}

	/**
	 *
	 *  Get address of chess club.
	 *
	 * @param string $year is optional, default is current year.
	 * @return array
	 */
	public static function get_club_address( $year = '' ) {

		$address = self::get_club_info( $year )['address'] ?? '';

		$address = array(
			'postal_code' => $address['postal_code'] ?? '',
			'street'      => $address['street'] ?? '',
			'city'        => $address['city'] ?? '',
		);

		return $address;
	}

	/**
	 *
	 *  Get the last available year of club data
	 *
	 *  @return string  */
	public static function get_club_last_year() {
		$club = self::get_club();

		$last_year = '';

		if ( ! empty( $club ) ) {
			$last_year = max( array_keys( $club ) );
		}
		return $last_year;
	}

	/**
	 *
	 *
	 *  Get the years data avaible for club.
	 *
	 * @return array  */
	public static function get_club_years() {
		$club = self::get_club();

		$years = array_keys( $club ) ?? array();

		return $years;
	}

	/**
	 *
	 * Get last year data avaible for club.
	 *
	 * @return mixed */
	public static function get_club_year_last() {

		$year = max( self::get_club_years() );

		return $year;
	}

	/**
	 *
	 * Get first year data avaible for club.
	 *
	 * @return mixed  */
	public static function get_year_first() {

		$year = min( self::get_club_years() );

		return $year;
	}

	/**
	 *
	 *  Get club website.
	 *
	 *   @param mixed $year is optional, default is current year.
	 *
	 *  @return string  */
	public static function get_club_website( $year = '' ) {

		$website = self::get_club_info( $year )['website'] ?? '';

		return $website;
	}

	/**
	 *
	 * Return array with total number of members and rookie.
	 *
	 * @param string $year optional, default is current year.
	 * @return mixed
	 */
	public static function get_club_number_members( $year = '' ) {
		$club = self::get_club();

		$members = array();

		if ( ! empty( $club ) ) {
			$year    = $year ? $year : self::get_club_last_year();
			$members = $club [ $year ]['stats'] ?? '';
		}

		return $members;
	}

	/**
	 *
	 *  Get array of members list based on year.
	 *
	 * @param string $year default value is current year.
	 * @return mixed
	 */
	public static function get_club_members_list( $year = '' ) {
		$club = self::get_club();

		$members_list = array();

		if ( ! empty( $club ) ) {
			$year = $year ? $year : self::get_club_last_year();

			$members_list = $club [ $year ]['members'] ?? array();

		}

		return $members_list;
	}

	/**
	 *
	 * Get array data of chess club.
	 *
	 * @return mixed  */
	public static function get_club() {
		$data    = self::get_club_data();
		$club_id = self::get_club_id();
		$club    = $data[ $club_id ] ?? array();
		return $club;
	}
}
