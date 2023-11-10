<?php // phpcs:disable Generic.Commenting.MissingFileComment

declare(strict_types=1); ?>


<p>
	<label for="<?php  echo esc_attr( $this->get_field_id( 'street' ) ); ?>">Street:</label>
	<input class="widefat" id="<?php  echo esc_attr( $this->get_field_id( 'street' ) ); ?>" name="<?php  echo esc_attr( $this->get_field_name( 'address[street]' ) ); ?>" type="text" value="<?php  echo esc_attr( $street ); ?>">
</p>
<p>
	<label for="<?php  echo esc_attr( $this->get_field_id( 'city' ) ); ?>">City:</label>
	<input class="widefat" id="<?php  echo esc_attr( $this->get_field_id( 'city' ) ); ?>" name="<?php  echo esc_attr( $this->get_field_name( 'address[city]' ) ); ?>" type="text" value="<?php  echo esc_attr( $city ); ?>">
</p>
<p>
	<label for="<?php  echo esc_attr( $this->get_field_id( 'postal_code' ) ); ?>">Postal Code:</label>
	<input class="widefat" id="<?php  echo esc_attr( $this->get_field_id( 'postal_code' ) ); ?>" name="<?php  echo esc_attr( $this->get_field_name( 'address[postal_code]' ) ); ?>" type="text" value="<?php  echo esc_attr( $postal_code ); ?>">
</p>
