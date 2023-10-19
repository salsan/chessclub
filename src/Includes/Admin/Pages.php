<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes\Admin;

final class Pages {
	const PLUGIN_PATH = MY_PLUGIN_PATH;

	public static function page_settings() {
		return require_once self::PLUGIN_PATH . '/admin/settings.php';
	}

	public static function section_settings() {
		echo 'Configure your account :';
	}

	public static function field_settings_select_club() {

		$list           = new \Salsan\Clubs\Listing();
		$selected_value = get_option( 'chessclub_settings', array() );

		echo '<select id="chessclub_settings" name="chessclub_settings">';
		echo '<option value="">Select Club</option>';

		foreach ( $list->clubs() as $index => $club ) {
			$selected = is_array( $selected_value ) ? ( ( $index == $selected_value['clubId'] ) ? 'selected' : '' ) : '';

			echo '<option value="' . $index . '" ' . $selected . '>' . $index . ' - ' . $club . '</option>';
		}

		echo '</select>';
	}


	public static function page_about() {
		return require_once self::PLUGIN_PATH . '/admin/about.php';
	}

}

