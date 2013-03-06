</div>

<?php
/**
 * Related Products
 */

global $product, $woocommerce_loop;

$related = $product->get_related(); 

if ( sizeof($related) == 0 ) return;

$args = apply_filters('woocommerce_related_products_args', array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'no_found_rows' 		=> 1,
	'posts_per_page' 		=> 8,
	'orderby' 				=> $orderby,
	'post__in' 				=> $related
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] 	= $columns;

if ( $products->have_posts() ) : ?>

	<div class="related products">

		<div class="title-box type01">
			<h2><?php _e('Related Products', 'woocommerce'); ?></h2>
		</div>
		
		<ul class="catalog">
			
			<?php while ( $products->have_posts() ) : $products->the_post(); ?>
		
				<?php woocommerce_get_template_part( 'content', 'product-related' ); ?>
	
			<?php endwhile; // end of the loop. ?>
				
		</ul>
		
	</div>
	
<?php endif; 

wp_reset_postdata();
