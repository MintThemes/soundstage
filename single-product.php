<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */


get_header(); ?>
    
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div class="title-block">
    <h1><?php the_title(); ?></h1>
</div>
<div id="main"><!-- main -->
			
				<div class="text-holder">
					<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>
				</div>
			<?php comments_template( '', true ); ?>	
				
			</div><!-- end main -->
        
<?php endwhile; // end of the loop. ?>
    
        
<?php get_footer(); ?> 