<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Soundstage
 * @since Soundstage 3.0
 */

get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div id="main"><!-- main -->
			<div id="content" <?php post_class(); ?>>
				<div class="text-holder">
					<h2><?php the_title(); ?></h2>
					<span class="undertitle"><?php _e('Posted by', 'mt_soundstage_translation'); ?> <?php the_author(); ?> <?php _e('on', 'mt_soundstage_translation'); ?> <?php the_time("F j, Y"); ?>
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
                            ?><?php the_tags(); ?> | <?php comments_number( __('No comments', 'mt_soundstage_translation'), __('One comment', 'mt_soundstage_translation'), '%' . __(' comments', 'mt_soundstage_translation') ); ?>
                     </span>
					<?php the_content(); ?>
				</div>
			<?php comments_template( '', true ); ?>	
            </div>
                <?php get_sidebar(); ?> 
                 
			
				
			</div><!-- end main -->
        
        <?php endwhile; // end of the loop. ?>
    
        
<?php get_footer(); ?> 
        
        