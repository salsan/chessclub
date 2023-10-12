<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes\Shortcodes;

/**
 *  WordPress Shortcode for Chess Club
 *
 * @package Salsan\Chessclub\Includes\Shortcodes
 */
class Website {
	/**
	 * Inizilization shortcode website club.
	 *
	 * @return void  */
	public function __construct() {
		add_shortcode( 'cc_website', array( $this, 'shortcode_cc_website' ) );
	}
	/**
	 *  Shortcode website club.
	 *
	 *  @param array $atts Array contain value for query.
	 *
	 *  $params = [
	 *      'id'   => (integer) id chess club on federation. Required.
	 *  ].
	 *
	 * @return string
	 */
	public function shortcode_cc_website( $atts ): string {
		$params = shortcode_atts(
			array(
				'id' => '',
			),
			$atts
		);

		$query = new \Salsan\Clubs\Query(
			array(
				'clubId' => $params['id'],
			)
		);

		return sanitize_text_field( $query->getInfo()[ $params['id'] ]['website'] );
	}
}
