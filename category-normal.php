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
					<?php if (have_posts()) : ?>
            		<?php while (have_posts()) : the_post(); ?>
        			<li id="post-<?php the_ID(); ?>" <?php post_class('main_posts_li'); ?> >
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
							<span class="date"><?php _e('posted: ', 'mt_soundstage_translation'); ?><?php the_time("F j, Y"); ?></span>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<a href="<?php the_permalink(); ?>" class="btn-more"><span><?php _e('View', 'mt_soundstage_translation'); ?></span></a>
						</div>
					</li>
                    <?php endwhile; // end of the loop. ?>
                    <?php endif; ?>
				</ul>
			</div>
             <?php get_template_part ('includes/pagination'); ?>
			
		</div><!-- end main -->
       
<?php get_footer(); ?>

                
   