<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes\Admin;

class Enqueue {
	private $items;
	private $plugin_url;

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

	public function init() {
		add_action( 'admin_init', array( $this, 'load_scripts' ) );
	}
}
