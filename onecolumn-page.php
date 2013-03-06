<?php
/**
 * Template Name: Full Width
 *
 * A custom page template.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Soundstage Theme by Mint Themes
 * @since Soundstage Theme by Mint Themes 3.0
 */

get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div class="title-block">
			<h1><?php the_title(); ?></h1>
		</div>
		<div id="main"><!-- main -->
			<div class="text-holder">
				<?php the_content(); ?>
			</div>
			<?php comments_template( '', true ); ?>	
		</div><!-- end main -->
    
    <?php endwhile; ?>
    
    <?php get_footer(); ?>

        