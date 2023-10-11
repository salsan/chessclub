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
 * Text Domain:       chessclub
 * Domain Path:       /languages
 *
 * @package ChessClub
 */

declare(strict_types=1);

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
function init(): void {
	if ( class_exists( 'Salsan\Chessclub\Includes\Shortcodes\Init' ) ) {
		Includes\Shortcodes\Init::add_shortcode();
	}
}

add_action( 'init', 'Salsan\Chessclub\init' );
