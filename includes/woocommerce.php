<?php
/**
 * WooCommerce Tweaks
 *
 */

function mt_soundstage_woocommerce() {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);

	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar' );

	remove_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display' );
}
add_action( 'after_setup_theme', 'mt_soundstage_woocommerce' );

function woocommerce_main_content_title() {
	if ( ! is_singular( 'product' ) )
		return;
?>
	<div class="title-block">
		<div class="container">
			<h1><?php the_title(); ?></h1>
			<a href="<?php echo esc_url( get_permalink( woocommerce_get_page_id( 'cart' ) ) ); ?>" class="add-to-cart button"><?php _e( 'View Cart', 'mt_soundstage_transate' ); ?></a>
		</div>
	</div>
<?php
}
add_action( 'woocommerce_before_main_content', 'woocommerce_main_content_title', 5 );

function woocommerce_before_single_product_summary() {
	echo '<div class="text">';
}
add_action( 'woocommerce_single_product_summary', 'woocommerce_before_single_product_summary', 0 );

function woocommerce_after_single_product_summary() {
	echo '</div>';
}
add_action( 'woocommerce_single_product_summary', 'woocommerce_after_single_product_summary', 100 );