<?php declare(strict_types=1);

echo '<select id="chessclub_settings" name="chessclub_settings">';
		echo '<option value="">Select Club</option>';

foreach ( $list->clubs() as $index => $club ) {
	$nation_id = 'IT' . $index;
	$selected  = is_array( $selected_value ) ? ( ( $nation_id == $club_id ) ? 'selected' : '' ) : '';

	echo '<option value="' . $nation_id . '" ' . $selected . '>' . $index . ' - ' . $club . '</option>';
}

echo '</select>';
