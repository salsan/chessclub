<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes\Enqueue;

/**
 *
 * Class Enqueue
 *
 * @package Salsan\Chessclub\Includes\Enqueue */
class Init {
	/**
	 * An array of assets (JavaScript and CSS) needed to load on the public page.
	 *
	 * @var array
	 */
	private $items;
	/**
	 * Path of the URL for assets (JavaScript and CSS).
	 *
	 * @var string
	 */
	private $plugin_url;

	/**
	 *
	 *  Constructor method to initialize the class.
	 *
	 * @return void  */
	public function __construct() {
		$this->plugin_url = MY_PLUGIN_URL;
		$this->items      = array(
			array(
				'handle' => 'flags-css',
				'src'    => $this->plugin_url . 'public/css/flags.css',
				'deps'   => array(),
				'ver'    => null,
				'args'   => false,
			),

		);
	}

	/**
	 * Load Admin Items
	 *
	 * @return void  */
	public function load_items() {
		foreach ( $this->items as $item ) {
			if ( strstr( $item['handle'], '-css' ) === false ) {
				wp_enqueue_script(
					$item['handle'],
					$item['src'],
					$item['deps'],
					$item['ver'],
					$item['args'],
				);
			} else {
				wp_enqueue_style(
					$item['handle'],
					$item['src'],
					$item['deps'],
					$item['ver'],
					$item['args'],
				);
			}
		}
	}

	/**
	 *
	 * Inizialization Admin Script
	 *
	 * @return void  */
	public function init() {
		add_action( 'wp_enqueue_scripts', array( $this, 'load_items' ) );
	}
}
