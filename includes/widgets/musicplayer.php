<?php
/**
 * Makes a custom Widget for displaying recent projects/portfolio
 *
 * Learn more: http://codex.wordpress.org/Widgets_API#Developing_Widgets
 *
 * @package Intro
 * @since Intro 1.0
 */

class mt_soundstage_Music_player extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'mt_soundstage_music_player',
			'description' =>  __( 'Only use once per page. Play tracks from the latest discography post.', 'mt_soundstage_translation' ),
		);
		parent::__construct( 'mt_soundstage_music_player',  __( 'Only use once per page. Play tracks from the latest discography post.', 'mt_soundstage_translation' ), $widget_ops );
	}

	/**
	 * Outputs the HTML for this widget.
	 *
	 * @param array An array of standard parameters for widgets in this theme
	 * @param array An array of settings for this widget instance
	 * @return void Echoes it's output
	 **/
	function widget( $args, $instance ) {
		$cache = wp_cache_get( 'mt_soundstage_music_player', 'widget' );

		if ( !is_array( $cache ) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = null;

		if ( isset( $cache[$args['widget_id']] ) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();

		extract( $args, EXTR_SKIP );

			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Music', 'mt_soundstage_translation' ) : $instance['title'], $instance, $this->id_base);

			echo $before_widget;
			echo $before_title;
			echo $title; // Can set this with a widget option, or omit altogether
			echo $after_title;
?>
				<div class="block">

       				<?php jplayer_code( array( 'show_thumb' => $instance[ 'thumb' ] ) ); ?>

				</div>
<?php
			echo $after_widget;

		$cache[$args['widget_id']] = ob_get_flush();

		wp_cache_set( 'mt_soundstage_music_player', $cache, 'widget' );
	}


	/**
	 * Deals with the settings when they are saved by the admin. Here is
	 * where any validation should be dealt with.
	 **/
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'thumb' ] = isset( $new_instance[ 'thumb' ] );

		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );

		if ( isset( $alloptions['mt_soundstage_music_player'] ) )
			delete_option( 'mt_soundstage_music_player' );

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete( 'mt_soundstage_music_player', 'widget' );
	}

	/**
	 * Displays the form for this widget on the Widgets page of the WP Admin area.
	 **/
	function form( $instance ) {
		$title = isset( $instance[ 'title' ] ) ? esc_attr( $instance[ 'title' ] ) : '';
		$thumb = isset( $instance[ 'thumb' ] ) && ! empty( $instance[ 'thumb' ] ) ? true : false;
?>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'mt_soundstage_translation' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'thumb' ) ); ?>">
					<input id="<?php echo esc_attr( $this->get_field_id( 'thumb' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'thumb' ) ); ?>" type="checkbox" <?php checked( true, $thumb ); ?>>
					<?php _e( 'Show album artwork', 'mt_soundstage_translation' ); ?>
				</label>
			</p>

            <p>
            	<label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php _e( 'Upload songs in the "Add New Post" section, refer to theme docs for more info.', 'mt_soundstage_translation' ); ?></label>
            </p>
<?php
	}
}
