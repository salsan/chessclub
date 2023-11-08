<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes\Widgets;

/**
 *
 *  WordPress Widget Address Chess Club
 *
 * @package Salsan\Chessclub\Includes\Widgets */
class ClubAddress extends \WP_Widget {

	/**
	 *
	 *  Address data
	 *
	 *  @var array  */

	public $address = array();


	/**
	 * Constructs id attributes for use in WP_Widget::form() fields.
	 *
	 * This function should be used in form() methods to create id attributes
	 * for fields to be saved by WP_Widget::update().
	 *
	 * @since 2.8.0
	 * @since 4.4.0 Array format field IDs are now accepted.
	 *
	 * @return void
	 **/
	public function __construct() {
		parent::__construct(
			'cc-address',
			'Address',
			array( 'description' => 'Chess Club Address Widget' )
		);

		$this->address = \Salsan\Chessclub\Includes\Chess\Clubs::get_address();
	}

	/**
	 * Echoes the widget content.
	 *
	 * Subclasses should override this function to generate their widget code.
	 *
	 * @since 2.8.0
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title', 'before_widget', and 'after_widget'.
	 * @param array $instance The settings for the particular instance of the widget.
	 */
	public function widget( $args, $instance ) {

		echo wp_kses(
			$args['before_widget'],
			array(
				'aside' => array(
					'class' => array(),
					'id'    => array(),
				),
			),
		);

		$address = ! empty( $instance['address'] ) ? $instance['address'] : $this->address;

		if ( ! empty( $address ) ) {
			echo '<p>' . esc_html( $address['street'] ) . ' - ';
			echo esc_html( $address['city'] );
			echo ' ( ' . esc_html( $address['postal_code'] ) . ' )</p>';
		}

		echo wp_kses( $args['after_widget'], array( 'aside' => array() ) );
	}

	/**
	 * Outputs the settings update form.
	 *
	 * @since 2.8.0
	 *
	 * @param array $instance Current settings.
	 * @return void
	 */
	public function form( $instance ) {
		$street      = ! empty( $instance['address']['street'] ) ? $instance['address']['street'] : $this->address['street'];
		$city        = ! empty( $instance['address']['city'] ) ? $instance['address']['city'] : $this->address['city'];
		$postal_code = ! empty( $instance['address']['postal_code'] ) ? $instance['address']['postal_code'] : $this->address['postal_code'];

		echo '<p>';
		echo '<label for="' . esc_attr( $this->get_field_id( 'street' ) ) . '">Street:</label>';
		echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'street' ) ) . '" name="' . esc_attr( $this->get_field_name( 'address[street]' ) ) . '" type="text" value="' . esc_attr( $street ) . '">';
		echo '</p>';

		echo '<p>';
		echo '<label for="' . esc_attr( $this->get_field_id( 'city' ) ) . '">City:</label>';
		echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'city' ) ) . '" name="' . esc_attr( $this->get_field_name( 'address[city]' ) ) . '" type="text" value="' . esc_attr( $city ) . '">';
		echo '</p>';

		echo '<p>';
		echo '<label for="' . esc_attr( $this->get_field_id( 'postal_code' ) ) . '">Postal Code:</label>';
		echo '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'postal_code' ) ) . '" name="' . esc_attr( $this->get_field_name( 'address[postal_code]' ) ) . '" type="text" value="' . esc_attr( $postal_code ) . '">';
		echo '</p>';
	}

	/**
	 * Updates a particular instance of a widget.
	 *
	 * This function should check that `$new_instance` is set correctly. The newly-calculated
	 * value of `$instance` should be returned. If false is returned, the instance won't be
	 * saved/updated.
	 *
	 * @since 2.8.0
	 *
	 * @param array $new_instance New settings for this instance as input by the user via WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Settings to save or bool false to cancel saving.
	 */
	public function update( $new_instance, $old_instance ) {
		$address = array(
			'street'      => sanitize_text_field( $new_instance['address']['street'] ),
			'city'        => sanitize_text_field( $new_instance['address']['city'] ),
			'postal_code' => sanitize_text_field( $new_instance['address']['postal_code'] ),
		);

		$new_instance['address'] = $address;

		return $new_instance;
	}
}
