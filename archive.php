<?php
/**
 * The template for displaying Archives Results pages.
 *
 * @package WordPress
 * @subpackage Soundstage
 * @since Soundstage 3.0
 */
 
 get_header(); ?>


<div class="title-block">
			<h1><?php the_title(); ?></h1>
		</div>
		<div id="main"><!-- main -->
			<div class="news">
            
         
				<ul class="catalog product">
					<?php if (have_posts()) : ?>
            		<?php while (have_posts()) : the_post(); ?>
        			<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="visual">
                        	<?php
                            $thumb = get_post_thumbnail_id();
                            $img_url = wp_get_attachment_url( $thumb,'full'); //get img URL
                            ?>
                            <?php if ($img_url != ""){?><img src="<?php echo aq_resize( $img_url, 306, 395, true );  ?>" width="306" height="305" alt="<?php the_title(); ?>" /><?php } ?>
                			<a class="mask" href="<?php the_permalink(); ?>">&nbsp;</a>
                           
                        </div>
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a>
					</li>
                    <?php endwhile; // end of the loop. ?>
                    <?php endif; ?>
				</ul>
			</div>
             <?php get_template_part ('includes/pagination'); ?>
			
		</div><!-- end main -->
       
<?php get_footer(); ?>

                
   