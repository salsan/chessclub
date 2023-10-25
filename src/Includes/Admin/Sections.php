<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes\Admin;

/**
 *
 *  Class Sections
 *
 * @package Salsan\Chessclub\Includes\Admin */
class Sections {
	/**
	 *
	 * List of sections
	 *
	 * @var array
	 */
	private $sections;

	/**
	 *
	 * Constructor method to initialize the class
	 *
	 * @return void  */
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

	/**
	 *
	 *  Add sections to page
	 *
	 *  @return void  */
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

	/**
	 *
	 *  Init sections to add on page
	 *
	 *  @return void  */
	public function init() {
		add_action( 'admin_init', array( $this, 'add_section' ) );
	}
}
