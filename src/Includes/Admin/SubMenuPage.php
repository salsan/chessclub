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

		register_setting( 'chessclub_settings', 'chessclub_settings' );

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

		add_option( 'chessclub_settings', '0' );
		add_action( 'update_option_chessclub_settings', array( $this, 'init_chessclub' ), 10, 2 );
	}

	public function init_chessclub() {
		$settings = get_option( 'chessclub_settings' );
		$query    = new \Salsan\Clubs\Query( array( 'clubId' => $settings['clubId'] ) );

		$club_info = $query->getInfo();

		if ( is_array( $club_info ) ) {
			$club_id = array_keys( $club_info );
			$club    = array( 'club' => $club_info[ $club_id[0] ] );
			$club    = array_merge( array( 'clubId' => $club_id[0] ), $club['club'] );

			update_option( 'chessclub_settings', $club );
		}
	}

	public function chessclub_id_callback() {
		echo 'Configure your account';
	}

	public function chessclub_id_field_callback() {
		$list           = new \Salsan\Clubs\Listing();
		$selected_value = get_option( 'chessclub_settings', array() );

		echo '<select id="chessclub_settings" name="chessclub_settings[clubId]">';
		echo '<option value="">Select Club</option>';

		foreach ( $list->clubs() as $index => $club ) {
			$selected = is_array( $selected_value ) ? ( ( $index == $selected_value['clubId'] ) ? 'selected' : '' ) : '';

			echo '<option value="' . $index . '" ' . $selected . '>' . $index . ' - ' . $club . '</option>';
		}

		echo '</select>';
	}
}
