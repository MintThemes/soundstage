<?php
/**
 *
 */

global $product;
?>

<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
<li>
	<div class="visual">
		<img src="<?php echo aq_resize( wp_get_attachment_url( get_post_thumbnail_id(), 'full' ), 306, 305, true );  ?>" width="306" height="305" alt="<?php the_title(); ?>" />
        <a class="mask" href="<?php the_permalink(); ?>">&nbsp;</a>
      	<?php woocommerce_template_loop_price(); ?>
    </div>
    <?php
		/** 
		 * woocommerce_before_shop_loop_item_title hook
		 *
		 * @hooked woocommerce_show_product_loop_sale_flash - 10
		 * @hooked woocommerce_template_loop_product_thumbnail - 10
		 */	  
		do_action( 'woocommerce_before_shop_loop_item_title' ); 
	?>
    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    <?php
		/** 
		 * woocommerce_after_shop_loop_item_title hook
		 *
		 * @hooked woocommerce_template_loop_price - 10
		 */	  
		do_action( 'woocommerce_after_shop_loop_item_title' ); 
	?>
</li>
<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>