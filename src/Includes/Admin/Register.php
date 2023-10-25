<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes\Admin;

/**
 *
 *  Class Register
 *
 * @package Salsan\Chessclub\Includes\Admin */
class Register {
	/**
	 *
	 *  List of registers
	 *
	 * @var array
	 */
	private $registers;

	/**
	 *
	 *  Constructor method to initialize the class
	 *
	 * @return void  */
	public function __construct() {
		$this->registers = array(
			array(
				'option-group' => 'chessclub_settings',
				'option-name'  => 'chessclub_settings',
				'args'         => 'Salsan\\Chessclub\\Includes\\Chess\\Clubs::init',
			),
		);
	}

	/**
	 *
	 *  Add registers to WordPress
	 *
	 * @return void  */
	public function add_register() {
		foreach ( $this->registers as $register ) {
			register_setting(
				$register['option-group'],
				$register['option-name'],
				$register['args']
			);
		}
	}


	/**
	 *
	 *  Init method to registers service
	 *
	 * @return void  */
	public function init() {
		add_action( 'admin_init', array( $this, 'add_register' ) );
	}
}
