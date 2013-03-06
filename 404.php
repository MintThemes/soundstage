<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Soundstage
 * @since Soundstage 3.0
 */

get_header(); ?>

<div id="main"><!-- main -->
			<div id="content">
				<div class="text-holder">
					<h2><?php _e('Oops! Not Found.', 'mt_soundstage_translation'); ?></h2>
						<?php _e( 'Not Found', 'mt_soundstage_translation' ); ?>
                        <p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'mt_soundstage_translation' ); ?></p>
                        <?php get_search_form(); ?>
				</div>
			<?php comments_template( '', true ); ?>	
            </div>
            <?php get_sidebar(); ?> 
                 
			
				
			</div><!-- end main -->

    
        
<?php get_footer(); ?> 
        
        