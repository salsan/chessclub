<?php declare(strict_types=1); ?>
<div class="wrap">
	<h2>Chess Club Settings</h2>
	<?php settings_errors(); ?>

	<form method="post" action="options.php">
				<?php
					settings_fields( 'chessclub_settings' );
					do_settings_sections( 'chessclub_menu');
					submit_button();
				?>
			</form>
	</div>
