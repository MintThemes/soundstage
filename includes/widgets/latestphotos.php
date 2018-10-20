<?php

/**

 * Makes a custom Widget for displaying recent projects/portfolio

 *

 * Learn more: http://codex.wordpress.org/Widgets_API#Developing_Widgets

 *

 * @package Intro

 * @since Intro 1.0

 */

class mt_soundstage_Latest_photos extends WP_Widget {



	/**

	 * Constructor

	 *

	 * @return void

	 **/

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'mt_soundstage_latest_photos',
			'description' => __( 'Display latest photos', 'mt_soundstage_translation' ),
		);
		parent::__construct( 'mt_soundstage_latest_photos',  __( 'Display latest photos', 'mt_soundstage_translation' ), $widget_ops );
	}



	/**

	 * Outputs the HTML for this widget.

	 *

	 * @param array An array of standard parameters for widgets in this theme

	 * @param array An array of settings for this widget instance

	 * @return void Echoes it's output

	 **/

	function widget( $args, $instance ) {

		$cache = wp_cache_get( 'mt_soundstage_latest_photos', 'widget' );



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



			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Latest Photos', 'mt_soundstage_translation' ) : $instance['title'], $instance, $this->id_base);



			echo $before_widget;

			echo $before_title;

			echo $title; // Can set this with a widget option, or omit altogether

			echo $after_title;

			?>

			<?php //WIDGET OUTPUT START ?>

			  <div class="block-photos">
				 <?php
					$args = array(
						'cat' => of_get_option('cap_photos_category'),
						'showposts' => 1,

					);
					$num = 0;
					$photos = new WP_Query($args);
					if($photos->have_posts() ) :
						while( $photos->have_posts() ) : $photos->the_post()
						?>

						 <ul class="photo-list visual">
								<?php
                                $args = array(
                                    'post_type' => 'attachment',
                                    'numberposts' => -1,
                                    'post_status' => null,
                                    'post_parent' => get_the_ID()
                                    );
                                $attachments = get_posts($args);
                                $currentAttachmentNum = 0;
                                //
                                if ($attachments) {
                                    $currentAttachmentNum = 0;
                                    foreach ($attachments as $attachment1) {?>
                                    <?php $num=$num+1; ?>

                                    <li>
                                        <img src="<?php echo aq_resize( $attachment1->guid, 92, 92, true );  ?>" width="92" height="92" alt=""/>
                                        <a href="<?php the_permalink(); ?>">&nbsp;</a>
                                    </li>

                                     <?php if ($num == 6){break;} ?>

                                <?php } } ?>
						</ul>


					<?php
					endwhile;
					wp_reset_postdata();
					endif;
					?>
              </div>

			<?php //END WIDGET OUTPUT

			echo $after_widget;






		if (!empty($args['widget_id'])){
			$cache[$args['widget_id']] = ob_get_flush();
		}

		wp_cache_set( 'mt_soundstage_latest_photos', $cache, 'widget' );

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

		if ( isset( $alloptions['mt_soundstage_latest_photos'] ) )

			delete_option( 'mt_soundstage_latest_photos' );



		return $instance;

	}



	function flush_widget_cache() {

		wp_cache_delete( 'mt_soundstage_latest_photos', 'widget' );

	}



	/**

	 * Displays the form for this widget on the Widgets page of the WP Admin area.

	 **/

	function form( $instance ) {

		$title = isset( $instance['title']) ? esc_attr( $instance['title'] ) : '';



?>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'mt_soundstage_translation' ); ?></label>

			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php _e( 'Select your "Photos" category in the "Theme Options" page', 'mt_soundstage_translation' ); ?></label>

		<?php

	}

}

//register widget in functions.php - function name: mt_soundstage_widgets_init
