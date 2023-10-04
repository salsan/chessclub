<?php
/**
 * Plugin Name:       Chess Club
 * Plugin URI:        https://github.com/salsan/Chess-Club
 * Description:       Chess Club Plugin for WordPress: Effortlessly Integrate Your Chess Club's Data into Your WordPress Website.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      8.1
 * Author:            Salvatore Santagati
 * Author URI:        https://salsan.dev/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       chess-club
 * Domain Path:       /languages
 *
 * @package ChessClub
 */

namespace chessclub;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly!
}

if ( file_exists( realpath( __DIR__ . '/vendor/autoload.php' ) ) ) {
	require_once realpath( __DIR__ . '/vendor/autoload.php' );
}

use Salsan\Members;

/**
 * Return total number of members of club for year.
 *
 * @param array $atts Array contain value for query.
 *
 *  $params = [
 *      'id'   => (integer) id chess club on federation. Required.
 *      'anno' => (date)  select year of subscription. Required.
 *      'type' => ('total', 'rookie') all is total members of club, rookie count only new member. Required.
 *
 * @return int
 */
function shortcode_cc_number_members( $atts ) {

	$params = shortcode_atts(
		array(
			'id'   => '',
			'year' => '',
			'type' => '',
		),
		$atts
	);

	$query = new Members\Query(
		array(
			'clubId'         => $params['id'],
			'membershipYear' => $params['year'],
		)
	);

	return sanitize_text_field( $query->getNumber()[ $params['type'] ] );
}

/**
 *  Inizialization shortcode
 *
 * @return void  */
function init_shortcode() {
	add_shortcode( 'cc_number_members', 'chessclub\shortcode_cc_number_members' );
}

add_action( 'init', 'chessclub\init_shortcode' );
