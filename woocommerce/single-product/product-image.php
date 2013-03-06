<?php
/**
 * Single Product Image
 */

global $post, $woocommerce;

?>

<div class="preview-block">
	<div class="preview">
		<div class="visual">
			<?php if ( has_post_thumbnail() ) : ?>

				<img src="<?php echo aq_resize( wp_get_attachment_url( get_post_thumbnail_id(), 'full' ), 473, 453, true );  ?>" width="473" height="453" alt="<?php the_title(); ?>" />
				<a href="#"></a>
			<?php else : ?>
			
				<img src="<?php echo woocommerce_placeholder_img_src(); ?>" alt="Placeholder" />
			
			<?php endif; ?>
			
        	<?php woocommerce_template_loop_price(); ?>
		</div>

		<?php do_action('woocommerce_product_thumbnails'); ?>
	</div>