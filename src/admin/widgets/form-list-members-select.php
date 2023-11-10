<?php // phpcs:disable Generic.Commenting.MissingFileComment

declare(strict_types=1); ?>

<label for=" <?php echo esc_attr( $this->get_field_id( 'years' ) ); ?>">Year</label>
<select id=" <?php echo esc_attr( $this->get_field_id( 'years' ) ); ?>" class="widefat" name=" <?php echo esc_attr( $this->get_field_name( 'years' ) ); ?>">
<option value="" <?php echo esc_attr( $is_selected ); ?> > Current</option>
