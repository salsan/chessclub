<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes\Admin;

/**
 *
 *  Class Menu
 *
 * @package Salsan\Chessclub\Includes\Admin */
class Menu {
	/**
	 *  List of menu items
	 *
	 * @var string[][]
	 */
	private $menu;

	/**
	 *
	 *  Constructor method to initialize the class
	 *
	 * @return void  */
	public function __construct() {

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
	/**
	 *
	 *  Add menu items to WordPress Admin
	 *
	 * @return void  */
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

	/**
	 *
	 *  Init menu to add on WordPress Admin
	 *
	 * @return void  */
	public function init() {
		add_action( 'admin_menu', array( $this, 'add_menu' ) );
	}
}
