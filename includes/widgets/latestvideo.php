<?php

/**

 * Makes a custom Widget for displaying recent projects/portfolio

 *

 * Learn more: http://codex.wordpress.org/Widgets_API#Developing_Widgets

 *

 * @package Intro

 * @since Intro 1.0

 */

class mt_soundstage_Latest_video extends WP_Widget {



	/**

	 * Constructor

	 *

	 * @return void

	 **/

	function mt_soundstage_Latest_video () {

		$widget_ops = array( 

			'classname' => 'mt_soundstage_latest_video', 

			'description' => __( 'Display latest video', 'mt_soundstage_translation' ) 

		);

		

		$this->WP_Widget( 'mt_soundstage_latest_video', __( 'Latest Video', 'mt_soundstage_translation' ), $widget_ops );

		$this->alt_option_name = 'mt_soundstage_latest_video';



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

		$cache = wp_cache_get( 'mt_soundstage_latest_video', 'widget' );



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



			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Latest Video', 'mt_soundstage_translation' ) : $instance['title'], $instance, $this->id_base);
			


			echo $before_widget;

			echo $before_title;

			echo $title; // Can set this with a widget option, or omit altogether

			echo $after_title;

			?>

			<?php //WIDGET OUTPUT START ?>

			  <div class="block">
				 <?php
					$args = array( 
						'cat' => of_get_option('cap_videos_category'),
						'showposts' => 1,
					);
					$videos = new WP_Query($args);
					if($videos->have_posts() ) :
						while( $videos->have_posts() ) : $videos->the_post()
						?>
						
				
                        <div class="video">
                        
                        		<?php
                                $thumb = get_post_thumbnail_id();
                                $img_url = wp_get_attachment_url( $thumb,'full'); //get img URL
                                ?>
                                <?php if ($img_url != ""){?><img src="<?php echo aq_resize( $img_url, 306, 215, true );  ?>" width="306" height="215" alt="<?php the_title(); ?>" /><?php } ?>
								<a href="<?php the_permalink(); ?>" class="mask">&nbsp;</a>
                                
                        </div>
                        <div class="video-title">
                            <span><?php echo substr(get_the_excerpt(), 0,30); ?>...</span>
                            <strong><?php the_title(); ?></strong>
                        </div>
				
					
                    	
					<?php 
					endwhile;
					wp_reset_postdata();
					endif;
					?>
              </div>
			
			<?php //END WIDGET OUTPUT

			echo $after_widget;

			

		



		$cache[$args['widget_id']] = ob_get_flush();

		wp_cache_set( 'mt_soundstage_latest_video', $cache, 'widget' );

	}



	/**

	 * Deals with the settings when they are saved by the admin. Here is

	 * where any validation should be dealt with.

	 **/

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		

		$this->flush_widget_cache();



		$alloptions = wp_cache_get( 'alloptions', 'options' );

		if ( isset( $alloptions['mt_soundstage_latest_video'] ) )

			delete_option( 'mt_soundstage_latest_video' );



		return $instance;

	}



	function flush_widget_cache() {

		wp_cache_delete( 'mt_soundstage_latest_video', 'widget' );

	}



	/**

	 * Displays the form for this widget on the Widgets page of the WP Admin area.

	 **/

	function form( $instance ) {

		$title = isset( $instance['title']) ? esc_attr( $instance['title'] ) : '';
		
		

?>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'mt_soundstage_translation' ); ?></label>

			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php _e( 'Select your "Videos" category in the "Theme Options" page', 'mt_soundstage_translation' ); ?></label>

		<?php

	}

}

//register widget in functions.php - function name: mt_soundstage_widgets_init





