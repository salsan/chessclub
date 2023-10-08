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

require_once __DIR__ . '/includes/shortcodes/number-members.php';
require_once __DIR__ . '/includes/shortcodes/number-members-total.php';
require_once __DIR__ . '/includes/shortcodes/number-members-rookie.php';


/**
 *  Inizialization shortcode
 *
 * @return void  */
function init_shortcode(): void {
	add_shortcode( 'cc_number_members', 'Salsan\Chessclub\Includes\Shortcodes\shortcode_cc_number_members' );
	add_shortcode( 'cc_number_members_total', 'Salsan\Chessclub\Includes\Shortcodes\shortcode_cc_number_members_total' );
	add_shortcode( 'cc_number_members_rookie', 'Salsan\Chessclub\Includes\Shortcodes\shortcode_cc_number_members_rokie' );
}

add_action( 'init', 'Salsan\Chessclub\init_shortcode' );
