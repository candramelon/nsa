<?php

/**

----------------------------------------------------------------------------------------------------

	Filename	: archives-widgets.php
	Location	: ../webtocrat/functions/backend/widgets/
	Author		: BAS - Webtocrat Motion
	Version		: 1.0.0
	Description	: Add Webtocrat Archives widget
	
----------------------------------------------------------------------------------------------------

	Table Of Contents
	
	1.0 - Define class widget.
	2.0 - Register widget

----------------------------------------------------------------------------------------------------

*/


/**
----------------------------------------------------------------------------------------------------
	1.0 - Define class widget.
----------------------------------------------------------------------------------------------------
*/
class Webtocrat_Archives_Custom_Widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'widget_archive', 'description' => __( 'A monthly archive of your site&#8217;s Posts.', 'webtocrat' ) );
		parent::__construct('archives', __('Archives', 'webtocrat' ), $widget_ops);

		add_filter( 'get_archives_link', array($this, 'archive_count_inline'		) );
		add_action( 'widgets_init',      array($this, 'remove_default_wp_widget' ) );
	}

	public function widget( $args, $instance ) {
		$c = ! empty( $instance['count'] ) ? '1' : '0';
		$d = ! empty( $instance['dropdown'] ) ? '1' : '0';

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = empty( $instance['title'] ) ? __( 'Archives', 'webtocrat' ) : $instance['title'];

		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		if ( $d ) {
			webtocrat_enqueue_style('webtocrat-select2');
			webtocrat_enqueue_script('webtocrat-select2-js');
?>
		<select class="webtocrat-select2" name="archive-dropdown" onchange='document.location.href=this.options[this.selectedIndex].value;'>
			<option value=""><?php echo esc_attr( __( 'Select Month', 'webtocrat' ) ); ?></option>

			<?php
			/**
			 * Filter the arguments for the Archives widget drop-down.
			 *
			 * @since 2.8.0
			 *
			 * @see wp_get_archives()
			 *
			 * @param array $args An array of Archives widget drop-down arguments.
			 */
			wp_get_archives( apply_filters( 'widget_archives_dropdown_args', array(
				'type'            => 'monthly',
				'format'          => 'option',
				'show_post_count' => $c
			) ) );
?>
		</select>
<?php
		} else {
?>
		<ul>
<?php
		/**
		 * Filter the arguments for the Archives widget.
		 *
		 * @since 2.8.0
		 *
		 * @see wp_get_archives()
		 *
		 * @param array $args An array of Archives option arguments.
		 */
		wp_get_archives( apply_filters( 'widget_archives_args', array(
			'type'            => 'monthly',
			'show_post_count' => $c
		) ) );
?>
		</ul>
<?php
		}

		echo $args['after_widget'];
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args( (array) $new_instance, array( 'title' => '', 'count' => 0, 'dropdown' => '') );
		$instance['title'] = $new_instance['title'];
		$instance['count'] = $new_instance['count'] ? 1 : 0;
		$instance['dropdown'] = $new_instance['dropdown'] ? 1 : 0;

		return $instance;
	}

	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'count' => 0, 'dropdown' => '') );
		$title = $instance['title'];
		$count = $instance['count'] ? 'checked="checked"' : '';
		$dropdown = $instance['dropdown'] ? 'checked="checked"' : '';
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'webtocrat' ); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo $dropdown; ?> id="<?php echo $this->get_field_id('dropdown'); ?>" name="<?php echo $this->get_field_name('dropdown'); ?>" /> <label for="<?php echo $this->get_field_id('dropdown'); ?>"><?php _e('Display as dropdown', 'webtocrat' ); ?></label>
			<br/>
			<input class="checkbox" type="checkbox" <?php echo $count; ?> id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" /> <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Show post counts', 'webtocrat' ); ?></label>
		</p>
<?php
	}

	/* Add span element archive count */
	public function archive_count_inline($links) {
		$links = str_replace('</a>&nbsp;(', '</a>&nbsp;<span class="count l">', $links);
		$links = str_replace(')</li>', '</span></li>', $links);
		return $links;
	}

	/* Remove default wp widget */
	public function remove_default_wp_widget() {
		unregister_widget('WP_Widget_Archives');
	}

}


/**
----------------------------------------------------------------------------------------------------
	2.0 - Register widget
----------------------------------------------------------------------------------------------------
*/
register_widget( 'Webtocrat_Archives_Custom_Widget' );