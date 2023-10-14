<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes\Admin;

class SubMenuPage {
	private $submenu_page_settings;
	private $plugin_path;

	public function __construct() {

		$this->plugin_path = MY_PLUGIN_PATH;

		$this->submenu_page_settings = array(
			array(
				'parent_slug' => 'chessclub_menu',
				'page_title'  => 'Chess Club Settings',
				'menu_title'  => 'Settings',
				'capability'  => 'manage_options',
				'menu_slug'   => 'chessclub_menu',
				'callback'    => array( $this, 'add_page_settings' ),
			),
			array(
				'parent_slug' => 'chessclub_menu',
				'page_title'  => 'About',
				'menu_title'  => 'About',
				'capability'  => 'manage_options',
				'menu_slug'   => 'chessclub_about',
				'callback'    => array( $this, 'add_page_about' ),
			),
		);

		add_action( 'admin_menu', array( $this, 'add_menu' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
	}

	public function add_menu() {

		foreach ( $this->submenu_page_settings as $submenu ) {
			add_submenu_page(
				$submenu ['parent_slug'],
				$submenu ['page_title'],
				$submenu ['menu_title'],
				$submenu ['capability'],
				$submenu ['menu_slug'],
				$submenu ['callback'],
			);
		}
	}

	public function add_page_settings() {
		return require_once "$this->plugin_path/admin/settings.php";
	}

	public function add_page_about() {
		return require_once "$this->plugin_path/admin/about.php";
	}

	public function register_settings() {
		$args = array(
			'type'              => 'string',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => null,
		);

		register_setting( 'chessclub_settings', 'chessclub_settings', $args );

		add_settings_section(
			'settings_section',
			'Settings',
			array( $this, 'chessclub_id_callback' ),
			'chessclub_menu'
		);

		add_settings_field(
			'chessclub_settings',
			'Club',
			array( $this, 'chessclub_id_field_callback' ),
			'chessclub_menu',
			'settings_section',
		);
	}

	public function chessclub_id_callback() {
		echo 'Configure your account';
	}

	public function chessclub_id_field_callback() {
		$value = get_option( 'chessclub_settings' );
		echo '<input type="text" name="chessclub_settings" value="' . esc_attr( $value ) . '" />';
	}
}
