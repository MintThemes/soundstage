<?php

/**

 * Makes a custom Widget for displaying recent projects/portfolio

 *

 * Learn more: http://codex.wordpress.org/Widgets_API#Developing_Widgets

 *

 * @package Intro

 * @since Intro 1.0

 */

class mt_soundstage_Social_links extends WP_Widget {



	/**

	 * Constructor

	 *

	 * @return void

	 **/

	function mt_soundstage_Social_links () {

		$widget_ops = array( 

			'classname' => 'mt_soundstage_social_links', 

			'description' => __( 'Display links to social networks.', 'mt_soundstage_translation' ) 

		);

		

		$this->WP_Widget( 'mt_soundstage_social_links', __( 'Social Links', 'mt_soundstage_translation' ), $widget_ops );

		$this->alt_option_name = 'mt_soundstage_social_links';



		add_action( 'save_post', array(&$this, 'flush_widget_cache' ) );

		add_action( 'deleted_post', array(&$this, 'flush_widget_cache' ) );

		add_action( 'switch_theme', array(&$this, 'flush_widget_cache' ) );

	}



	/**

	 * Outputs the HTML for this widget.

	 *

	 * @param array An array of standard parameters for widgets in this theme

	 * @param array An array of settings for this widget instance

	 * @return void Echoes it's output

	 **/

	function widget( $args, $instance ) {

		$cache = wp_cache_get( 'mt_soundstage_social_links', 'widget' );



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



			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Social Links', 'mt_soundstage_translation' ) : $instance['title'], $instance, $this->id_base);
			$twitter = apply_filters( 'twitter', empty( $instance['twitter'] ) ? __( '', 'mt_soundstage_translation' ) : $instance['twitter'], $instance, $this->id_base);
			$vimeo = apply_filters( 'vimeo', empty( $instance['vimeo'] ) ? __( '', 'mt_soundstage_translation' ) : $instance['vimeo'], $instance, $this->id_base);
			$facebook = apply_filters( 'facebook', empty( $instance['facebook'] ) ? __( '', 'mt_soundstage_translation' ) : $instance['facebook'], $instance, $this->id_base);
			$googleplus = apply_filters( 'googleplus', empty( $instance['googleplus'] ) ? __( '', 'mt_soundstage_translation' ) : $instance['googleplus'], $instance, $this->id_base);
			$youtube = apply_filters( 'youtube', empty( $instance['youtube'] ) ? __( '', 'mt_soundstage_translation' ) : $instance['youtube'], $instance, $this->id_base);
			$flickr = apply_filters( 'flickr', empty( $instance['flickr'] ) ? __( '', 'mt_soundstage_translation' ) : $instance['flickr'], $instance, $this->id_base);


			echo $before_widget;

			echo $before_title;

			echo $title; // Can set this with a widget option, or omit altogether

			echo $after_title;

			?>

			<?php //WIDGET OUTPUT START ?>

			<ul class="footer-social">
				 <?php if ($vimeo != ""){ if ($vimeo != ""){?>
					<li><a href="<?php echo $instance['vimeo'] ?>"><?php _e('Vimeo', 'mt_soundstage_translation'); ?></a></li>
                 <?php } }?>
                 <?php if ($twitter != ""){ if ($instance['twitter'] != ""){?>
					<li><a class="alt03" href="<?php echo $instance['twitter'] ?>"><?php _e('Twitter', 'mt_soundstage_translation'); ?></a></li>
                 <?php } }?>
				 <?php if ($facebook != ""){ if ($instance['facebook'] != ""){?>
					<li><a class="alt04" href="<?php echo $instance['facebook'] ?>"><?php _e('Facebook', 'mt_soundstage_translation'); ?></a></li>
                 <?php } }?>
                 <?php if ($googleplus != ""){ if ($instance['googleplus'] != ""){?>
					<li><a class="alt02" href="<?php echo $instance['googleplus'] ?>"><?php _e('Google+', 'mt_soundstage_translation'); ?></a></li>
                 <?php } }?>
				<?php if ($youtube != ""){ if ($instance['youtube'] != ""){?>
					<li><a class="alt01" href="<?php echo $instance['youtube'] ?>"><?php _e('YouTube', 'mt_soundstage_translation'); ?></a></li>
                 <?php } }?>
                 <?php if ($flickr != ""){ if ($instance['flickr'] != ""){?>
					<li><a class="alt05" href="<?php echo $instance['flickr'] ?>"><?php _e('Flickr', 'mt_soundstage_translation'); ?></a></li>
                 <?php } }?>
				 
			</ul>
			
			<?php //END WIDGET OUTPUT

			echo $after_widget;

			

		



		$cache[$args['widget_id']] = ob_get_flush();

		wp_cache_set( 'mt_soundstage_social_links', $cache, 'widget' );

	}



	/**

	 * Deals with the settings when they are saved by the admin. Here is

	 * where any validation should be dealt with.

	 **/

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['twitter'] = strip_tags( $new_instance['twitter'] );
		$instance['facebook'] = strip_tags( $new_instance['facebook'] );
		$instance['vimeo'] = strip_tags( $new_instance['vimeo'] );
		$instance['flickr'] = strip_tags( $new_instance['flickr'] );
		$instance['youtube'] = strip_tags( $new_instance['youtube'] );
		$instance['googleplus'] = strip_tags( $new_instance['googleplus'] );
		

		$this->flush_widget_cache();



		$alloptions = wp_cache_get( 'alloptions', 'options' );

		if ( isset( $alloptions['mt_soundstage_social_links'] ) )

			delete_option( 'mt_soundstage_social_links' );



		return $instance;

	}



	function flush_widget_cache() {

		wp_cache_delete( 'mt_soundstage_social_links', 'widget' );

	}



	/**

	 * Displays the form for this widget on the Widgets page of the WP Admin area.

	 **/

	function form( $instance ) {

		$title = isset( $instance['title']) ? esc_attr( $instance['title'] ) : '';
		
		$twitter = isset( $instance['twitter']) ? esc_attr( $instance['twitter'] ) : '';
		$vimeo = isset( $instance['vimeo']) ? esc_attr( $instance['vimeo'] ) : '';
		$facebook = isset( $instance['facebook']) ? esc_attr( $instance['facebook'] ) : '';
		$youtube = isset( $instance['youtube']) ? esc_attr( $instance['youtube'] ) : '';
		$flickr = isset( $instance['flickr']) ? esc_attr( $instance['flickr'] ) : '';
		$googleplus = isset( $instance['googleplus']) ? esc_attr( $instance['googleplus'] ) : '';
		

?>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'mt_soundstage_translation' ); ?></label>

			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>


<?php //twitter ?>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>"><?php _e( 'Twitter URL:', 'mt_soundstage_translation' ); ?></label>

			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter' ) ); ?>" type="text" value="<?php echo esc_attr( $twitter ); ?>" /></p>
           

<?php //vimeo ?>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'vimeo' ) ); ?>"><?php _e( 'Vimeo URL:', 'mt_soundstage_translation' ); ?></label>

			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'vimeo' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'vimeo' ) ); ?>" type="text" value="<?php echo esc_attr( $vimeo ); ?>" /></p>
            
<?php //facebook ?>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>"><?php _e( 'Facebook URL:', 'mt_soundstage_translation' ); ?></label>

			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) ); ?>" type="text" value="<?php echo esc_attr( $facebook ); ?>" /></p>
            
<?php //youtube ?>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>"><?php _e( 'YouTube URL:', 'mt_soundstage_translation' ); ?></label>

			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'youtube' ) ); ?>" type="text" value="<?php echo esc_attr( $youtube ); ?>" /></p>

<?php //flickr ?>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'flickr' ) ); ?>"><?php _e( 'Flickr URL:', 'mt_soundstage_translation' ); ?></label>

			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'flickr' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'flickr' ) ); ?>" type="text" value="<?php echo esc_attr( $flickr ); ?>" /></p>
            
<?php //googleplus ?>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'googleplus' ) ); ?>"><?php _e( 'Google+ URL:', 'mt_soundstage_translation' ); ?></label>

			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'googleplus' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'googleplus' ) ); ?>" type="text" value="<?php echo esc_attr( $googleplus ); ?>" /></p>

		<?php

	}

}

//register widget in functions.php - function name: mt_soundstage_widgets_init
