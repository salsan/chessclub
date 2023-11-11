<?php // phpcs:disable Generic.Commenting.MissingFileComment
declare(strict_types=1);
?>
<select id="chessclub_settings" name="chessclub_settings[id]" class="federation">
	<option value="">Select Federation</option>
	<?php echo \Salsan\Chessclub\Includes\Chess\Html::form_option_federation(); ?>
</select>
