<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes\Admin;

class Fields {

	private $fields;

	public function __construct() {
		$this->fields = array(
			array(
				'id'       => 'chessclub_settings',
				'title'    => 'Club',
				'callback' => 'Salsan\\Chessclub\\Includes\\Admin\\Pages::field_settings_select_club',
				'page'     => 'chessclub_menu',
				'section'  => 'settings_section',
			),
		);
	}

	public function add_field() {

		foreach ( $this->fields as $field ) {
			add_settings_field(
				$field['id'],
				$field['title'],
				$field['callback'],
				$field['page'],
				$field['section'],
			);
		}
	}

	public function init() {
		add_action( 'admin_init', array( $this, 'add_field' ) );
	}
}
