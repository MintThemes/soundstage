<?php
/**
 * The Template for displaying all single tour dates.
 *
 * @package WordPress
 * @subpackage Soundstage
 * @since Soundstage 3.0
 */

get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div id="main"><!-- main -->
			<div id="content">
				<div class="text-holder">
					<h2><?php the_title(); ?></h2>
					<span class="undertitle"><?php echo mt_soundstage_eventposttype_get_the_event_date(); ?></span>
					<?php the_content(); ?>
				</div>
			<?php comments_template( '', true ); ?>	
            </div>
                <?php get_sidebar(); ?> 
                 
			
				
			</div><!-- end main -->
        
        <?php endwhile; // end of the loop. ?>
    
        
<?php get_footer(); ?> 
        
        