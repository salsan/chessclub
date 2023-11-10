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
}
