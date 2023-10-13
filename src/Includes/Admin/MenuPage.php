<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes\Admin;

class MenuPage {

	private $menu_page_settings;
	private $plugin_path;

	public function __construct() {

		$this->plugin_path = MY_PLUGIN_PATH;

		$this->menu_page_settings = array(
			'page_title' => 'ChessClub',
			'menu_title' => 'Chess Club',
			'capability' => 'manage_options',
			'menu_slug'  => 'chessclub_menu',
			'callback'   => array( $this, 'addPage' ),
			'icon_url'   => 'dashicons-groups',
		);

		add_action( 'admin_menu', array( $this, 'addMenuPage' ) );
	}
	public function addMenuPage() {
		add_menu_page(
			$this->menu_page_settings['page_title'],
			$this->menu_page_settings['menu_title'],
			$this->menu_page_settings['capability'],
			$this->menu_page_settings['menu_slug'],
			$this->menu_page_settings['callback'],
			$this->menu_page_settings['icon_url'],
		);
	}

	public function addPage() {
		return require_once "$this->plugin_path/admin/main.php";
	}
}
