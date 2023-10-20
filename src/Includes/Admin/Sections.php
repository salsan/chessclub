<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes\Admin;

class Sections {

	private $sections;

	public function __construct() {
		$this->sections = array(
			array(
				'id'       => 'settings_section',
				'title'    => 'Settings',
				'callback' => 'Salsan\\Chessclub\\Includes\\Admin\\Pages::section_settings',
				'page'     => 'chessclub_menu',
			),
		);

		add_action( 'admin_init', array( $this, 'add_section' ) );
	}

	public function add_section() {

		foreach ( $this->sections as $section ) {
			add_settings_section(
				$section['id'],
				$section['title'],
				$section['callback'],
				$section['page']
			);
		}
	}

	public function init() {
		add_action( 'admin_init', array( $this, 'add_section' ) );
	}
}
