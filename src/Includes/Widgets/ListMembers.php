<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName

declare(strict_types=1);

namespace Salsan\Chessclub\Includes\Widgets;

use Salsan\Utils\String\HiddenSpaceTrait;


/**
 *
 *  WordPress Widget Address Chess Club
 *
 * @package Salsan\Chessclub\Includes\Widgets
 * */
class ListMembers extends \WP_Widget {
	use HiddenSpaceTrait;

	const PLUGIN_PATH = MY_PLUGIN_PATH;

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
			'cc-list-members',
			'Members',
			array( 'description' => 'Chess Club Members' )
		);
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
		$years         = \Salsan\Chessclub\Includes\Chess\Clubs::get_club_years();
		$selected_year = $instance['years'] ?? '';
		$is_selected   = $selected_year === $years ? 'selected' : '';

		include self::PLUGIN_PATH . 'admin/widgets/form-list-members-select.php';

		foreach ( $years as $year ) {
			$is_selected = $selected_year === (string) $year ? 'selected' : '';

			include self::PLUGIN_PATH . 'admin/widgets/form-list-members-select-option.php';
		}

		?>
		</select>
		<?php
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
		$instance          = array();
		$instance['years'] = ( ! empty( $new_instance['years'] ) ) ? wp_strip_all_tags( $new_instance['years'] ) : '';
		return $instance;
	}

	/**
	 * Echoes the widget content.
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

		$members_list = \Salsan\Chessclub\Includes\Chess\Clubs::get_club_members_list( $instance['years'] );
		$table        = '';

		if ( ! empty( $members_list ) ) {

			$table = '<table>
			<tr>
			  <th>Name</th>
			  <th>Category</th>
			  <th>Nation</th>
			</tr>';

			foreach ( $members_list as $id => $member ) {
				$experience = $member['isRookie'] ? 'rookie' : 'expert';

				$table .= '<tr>
							<td class=member-' . $experience . ' id=' . $id . '>' . $member['name'] . '</td>
							<td>' . $member['category'] . '</td>
							<td class=flag-' . $this->replaceWithStandardSpace( $member['citizenship'] ) . '></td>
						</tr>';
			}
		}

		$table .= '' === $table ? '' : '</table>';

		echo wp_kses(
			$table,
			array(
				'table' => array(),
				'tr'    => array(),
				'th'    => array(),
				'td'    => array(
					'class' => array(),
					'id'    => array(),
				),
			)
		);

		echo wp_kses( $args['after_widget'], array( 'aside' => array() ) );
	}
}
