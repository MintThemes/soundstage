<?php
/**
 * The Template for displaying all single videos.
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
					<span class="undertitle"> Posted by <?php the_author(); ?> on <?php the_time("F j, Y"); ?>
							<?php                            
                            $post_categories = wp_get_post_categories( get_the_ID() );
                            $cats = array();
                                
                            foreach($post_categories as $c){
                                $cat = get_category( $c );
                                $cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug );
                                ?>
                                <a href="<?php echo site_url(); ?>/category/<?php echo $cat->slug; ?>"><?php echo $cat->name; ?></a>
                                | <?php
                            }
                            ?><?php comments_number( __('No comments', 'mt_soundstage_translation'), __('One comment', 'mt_soundstage_translation'), '%' . __(' comments', 'mt_soundstage_translation') ); ?>
                     </span>
                
                        <div id="video">
                            <?php mt_soundstage_the_video(); ?>
                        </div>
                     
					<?php the_content(); ?>
				</div>
			<?php comments_template( '', true ); ?>	
            </div>
                <?php get_sidebar(); ?> 
                 
			
				
			</div><!-- end main -->
        
        <?php endwhile; // end of the loop. ?>
    
        
<?php get_footer(); ?> 
        
        