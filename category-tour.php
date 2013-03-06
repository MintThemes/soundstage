<?php
/**
 * The template for displaying Category Results pages.
 *
 * @package WordPress
 * @subpackage Soundstage
 * @since Soundstage 3.0
 */
get_header(); ?>


<div class="title-block">
			<h1><?php echo single_cat_title( '', false );?></h1>
		</div>
		<div id="main"><!-- main -->
			<div class="news">
            
         
				<ul class="main_posts">
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
					'paged' => $paged
					);
					$events = new WP_Query($args);
					if($events->have_posts() ) :
						while( $events->have_posts() ) : $events->the_post() ?>

					
        			<li id="post-<?php the_ID(); ?>" <?php post_class('main_posts_li'); ?>>
						<div class="visual">
							<?php
                            $thumb = get_post_thumbnail_id();
                            $img_url = wp_get_attachment_url( $thumb,'full'); //get img URL
                            ?>
                            <?php if ($img_url != ""){?><img src="<?php echo aq_resize( $img_url, 140, 140, true );  ?>" width="140" height="140" alt="<?php the_title(); ?>" />
							<a href="<?php the_permalink(); ?>">&nbsp;</a>
                            <?php } ?>
						</div>
						<div class="text">
							<span class="date"><?php _e('date: ', 'mt_soundstage_translation'); ?><?php echo mt_soundstage_eventposttype_get_the_event_date_without_hour(); ?></span>
                            <span class="date"><?php _e('time: ', 'mt_soundstage_translation'); ?><?php echo mt_soundstage_eventposttype_get_the_event_time_only(); ?></span>
							<h3><?php the_title(); ?><br />
                            <?php echo get_post_meta($post->ID, "event_venue", true); ?>, <?php echo get_post_meta($post->ID, "event_city", true); ?></h3>
							<?php if (get_post_meta($post->ID, "button_text", true) != ""){?><a href="<?php echo get_post_meta($post->ID, "button_link", true); ?>" class="btn-more"><span><?php echo get_post_meta($post->ID, "button_text", true); ?></span></a><?php } ?>
						</div>
					</li>
                    <?php endwhile; // end of the loop. ?>
                    <?php endif; ?>
				</ul>
			</div>
             <?php get_template_part ('includes/pagination'); ?>
			
		</div><!-- end main -->
       
<?php get_footer(); ?>

                
   