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

namespace Salsan\Chessclub;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly!
}

if ( file_exists( realpath( __DIR__ . '/vendor/autoload.php' ) ) ) {
	require_once realpath( __DIR__ . '/vendor/autoload.php' );
}

/**
 *  Inizialization shortcodes
 *
 * @return void  */
function init_shortcode(): void {

	$shortcodes = array(
		'number_members',
		'number_members_total',
		'number_members_rookie',
		'info_club_phone_number',
		'info_club_website',
	);

	foreach ( $shortcodes as $shortcode ) {
		if ( ! shortcode_exists( 'cc_' . $shortcode ) ) {
			require_once __DIR__ . '/includes/shortcodes/' . str_replace( '_', '-', $shortcode ) . '.php';

			add_shortcode( 'cc_' . $shortcode, __NAMESPACE__ . '\Includes\Shortcodes\\shortcode_cc_' . $shortcode );
		}
	}
}

add_action( 'init', 'Salsan\Chessclub\init_shortcode' );
