<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes\Admin;

class Register {
	private $registers;

	public function __construct() {
		$this->registers = array(
			array(
				'option-group' => 'chessclub_settings',
				'option-name'  => 'chessclub_settings',
				'args'         => 'Salsan\\Chessclub\\Includes\\Chess\\Clubs::init',
			),
		);
	}

	public function add_register() {
		foreach ( $this->registers as $register ) {
			register_setting(
				$register['option-group'],
				$register['option-name'],
				$register['args']
			);
		}
	}


	public function init() {
		add_action( 'admin_init', array( $this, 'add_register' ) );
	}
}
