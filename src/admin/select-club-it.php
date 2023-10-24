<?php declare(strict_types=1);

echo '<select id="chessclub_settings" name="chessclub_settings">';
		echo '<option value="">Select Club</option>';

		echo  \Salsan\Chessclub\Includes\Chess\Html::form_option_club_it();

echo '</select>';
