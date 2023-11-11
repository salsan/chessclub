<?php // phpcs:disable Generic.Commenting.MissingFileComment
declare(strict_types=1);
?>
<select id="chessclub_settings" name="chessclub_settings[id]">
	<option value="">Select Club</option>
	<?php echo \Salsan\Chessclub\Includes\Chess\Html::form_option_club_it(); ?>
</select>
