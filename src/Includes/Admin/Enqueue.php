<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes\Admin;

/**
 *
 * Class Enqueue
 *
 * @package Salsan\Chessclub\Includes\Admin */
class Enqueue {
	/**
	 * An array of assets (JavaScript and CSS) needed to load on the admin page.
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
				'handle' => 'form-js',
				'src'    => $this->plugin_url . '/admin/js/form.js',
				'deps'   => array(),
				'ver'    => null,
				'args'   => true,
			),
		);
	}

	/**
	 * Load Admin Scripts
	 *
	 * @return void  */
	public function load_scripts() {
		foreach ( $this->items as $item ) {
			wp_enqueue_script(
				$item['handle'],
				$item['src'],
				$item['deps'],
				$item['ver'],
				$item['args'],
			);
		}
	}

	/**
	 *
	 * Inizialization Admin Script
	 *
	 * @return void  */
	public function init() {
		add_action( 'admin_init', array( $this, 'load_scripts' ) );
	}
}
