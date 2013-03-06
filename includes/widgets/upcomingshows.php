<?php

/**

 * Makes a custom Widget for displaying recent projects/portfolio

 *

 * Learn more: http://codex.wordpress.org/Widgets_API#Developing_Widgets

 *

 * @package Intro

 * @since Intro 1.0

 */

class mt_soundstage_Upcoming_shows extends WP_Widget {



	/**

	 * Constructor

	 *

	 * @return void

	 **/

	function mt_soundstage_Upcoming_shows () {

		$widget_ops = array( 

			'classname' => 'mt_soundstage_upcoming_shows', 

			'description' => __( 'Display upcoming shows', 'mt_soundstage_translation' ) 

		);

		

		$this->WP_Widget( 'mt_soundstage_upcoming_shows', __( 'Upcoming Shows', 'mt_soundstage_translation' ), $widget_ops );

		$this->alt_option_name = 'mt_soundstage_upcoming_shows';



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

		$cache = wp_cache_get( 'mt_soundstage_upcoming_shows', 'widget' );



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



			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Upcoming Shows', 'mt_soundstage_translation' ) : $instance['title'], $instance, $this->id_base);
			


			echo $before_widget;

			echo $before_title;

			echo $title; // Can set this with a widget option, or omit altogether

			echo $after_title;

			?>

			<?php //WIDGET OUTPUT START ?>

			  <div class="block">
		<ul class="item-list">
				
                <?php 
					$current_time = current_time('mysql');
					list( $today_year, $today_month, $today_day, $hour, $minute, $second ) = split( '([^0-9])', $current_time );
					$current_timestamp = $today_year . $today_month . $today_day . $hour . $minute;
					$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
					$args = array( 
					'meta_query' => array(
						array(
							'key' => '_start_eventtimestamp',
							'value' => $current_timestamp,
							'compare' => '>'
						)
					),
					'orderby' => 'meta_value_num',
					'meta_key' => '_start_eventtimestamp',
					'order' => 'ASC',
					'cat' => of_get_option('cap_events_cat'),
					'showposts' => 4
					);
					$events = new WP_Query($args);
					if($events->have_posts() ) :
						while( $events->have_posts() ) : $events->the_post() ?>

						
                        <li>
							<strong><?php echo mt_soundstage_eventposttype_get_the_event_date_without_year(); ?></strong>
							<span><?php the_title(); ?></span>
							<a href="<?php the_permalink(); ?>" class="btn">&nbsp;</a>
						</li>	
					
                    	
					<?php 
					endwhile;
					wp_reset_postdata();
					else:
					?>
					
                     <li>
							
							<span><?php _e('No Shows Listed.', 'mt_soundstage_translation'); ?></span>
							
						</li>	
                    
					<?php endif; ?>
					
                    
                </ul>        
       				<div class="item-box">
						<?php $category_id = of_get_option('cap_events_cat'); ?>                            
                        <a class="more" href="<?php echo get_category_link(of_get_option('cap_events_cat')); ?>"><?php _e('View All Dates', 'mt_soundstage_translation'); ?></a>
					</div>
                </div>
			
			<?php //END WIDGET OUTPUT

			echo $after_widget;

			

		



		$cache[$args['widget_id']] = ob_get_flush();

		wp_cache_set( 'mt_soundstage_upcoming_shows', $cache, 'widget' );

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

		if ( isset( $alloptions['mt_soundstage_upcoming_shows'] ) )

			delete_option( 'mt_soundstage_upcoming_shows' );



		return $instance;

	}



	function flush_widget_cache() {

		wp_cache_delete( 'mt_soundstage_upcoming_shows', 'widget' );

	}



	/**

	 * Displays the form for this widget on the Widgets page of the WP Admin area.

	 **/

	function form( $instance ) {

		$title = isset( $instance['title']) ? esc_attr( $instance['title'] ) : '';
		
		

?>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'mt_soundstage_translation' ); ?></label>

			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php _e( 'Select your "Shows" category in the "Theme Options" page', 'mt_soundstage_translation' ); ?></label>

		<?php

	}

}

//register widget in functions.php - function name: mt_soundstage_widgets_init





