<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes\Admin;

class Menu {

	private $menu;

	public function __construct() {

		// register_setting( 'chessclub_settings', 'chessclub_settings', 'Salsan\\Chessclub\\Includes\\Chess\\Clubs::init' );

		$this->plugin_path = MY_PLUGIN_PATH;

		$this->menu = array(
			array(
				'page_title' => 'ChessClub',
				'menu_title' => 'Chess Club',
				'capability' => 'manage_options',
				'menu_slug'  => 'chessclub_menu',
				'callback'   => '',
				'icon_url'   => 'dashicons-groups',
			),
			array(
				'parent_slug' => 'chessclub_menu',
				'page_title'  => 'Chess Club',
				'menu_title'  => 'Settings',
				'capability'  => 'manage_options',
				'menu_slug'   => 'chessclub_menu',
				'callback'    => 'Salsan\\Chessclub\\Includes\\Admin\\Pages::page_settings',
			),
			array(
				'parent_slug' => 'chessclub_menu',
				'page_title'  => 'About',
				'menu_title'  => 'About',
				'capability'  => 'manage_options',
				'menu_slug'   => 'chessclub_about',
				'callback'    => 'Salsan\\Chessclub\\Includes\\Admin\\Pages::page_about',
			),
		);
	}
	public function add_menu() {

		foreach ( $this->menu as $item ) {

			if ( array_key_exists( 'parent_slug', $item ) ) {
				add_submenu_page(
					$item ['parent_slug'],
					$item ['page_title'],
					$item ['menu_title'],
					$item ['capability'],
					$item ['menu_slug'],
					$item ['callback'],
				);
			} else {
				add_menu_page(
					$item['page_title'],
					$item['menu_title'],
					$item['capability'],
					$item['menu_slug'],
					$item['callback'],
					$item['icon_url'],
				);
			}
		}
	}

	public function init() {
		add_action( 'admin_menu', array( $this, 'add_menu' ) );
	}
}
