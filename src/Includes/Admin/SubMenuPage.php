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

		register_setting( 'chessclub_settings', 'chessclub_settings', array( $this, 'init_chessclub' ) );

		add_settings_section(
			'settings_section',
			'Settings',
			array( $this, 'chessclub_id_callback' ),
			'chessclub_menu'
		);

		add_settings_field(
			'chessclub_settings',
			'Club',
			array( $this, 'chessclub_setup' ),
			'chessclub_menu',
			'settings_section',
		);
	}

	public function init_chessclub( $id ) {

		$data         = new \Salsan\Clubs\Form();
		$current_year = max( $data->getYears() );
		$first_year   = min( $data->getYears() );

		$club = array( 'clubId' => $id );

		for ( $year = $current_year; $year >= $first_year; $year-- ) {
			$query     = new \Salsan\Clubs\Query(
				array(
					'clubId' => $id,
					'year'   => $year,
				)
			);
			$club_info = $query->getInfo();

			if ( count( $club_info ) > 0 ) {
				$members = new \Salsan\Members\Query(
					array(
						'clubId'         => $id,
						'membershipYear' => $year,
					)
				);

				$list = $members->getList();
				$club = array_merge( $club, $club_info[ $id ] );
				array_push( $club, array( 'members' => $list ) );

				return $club;
			}
		}

		return $club;
	}

	public function chessclub_id_callback() {
		echo 'Configure your account';
	}

	public function chessclub_setup() {
		$list           = new \Salsan\Clubs\Listing();
		$selected_value = get_option( 'chessclub_settings', array() );

		echo '<select id="chessclub_settings" name="chessclub_settings">';
		echo '<option value="">Select Club</option>';

		foreach ( $list->clubs() as $index => $club ) {
			$selected = is_array( $selected_value ) ? ( ( $index == $selected_value['clubId'] ) ? 'selected' : '' ) : '';

			echo '<option value="' . $index . '" ' . $selected . '>' . $index . ' - ' . $club . '</option>';
		}

		echo '</select>';
	}
}
