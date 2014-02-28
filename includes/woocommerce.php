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

/**
 * Hook in on activation
 */
global $pagenow;
add_action( 'init', 'yourtheme_woocommerce_image_dimensions', 1 );
 
/**
 * Define image sizes
 */
function yourtheme_woocommerce_image_dimensions() {
	
	$shop_single_image_size['width'] 	= '469';
	$shop_single_image_size['height'] = '469';
	$shop_single_image_size['crop'] 	= '1';
	 
	return $shop_single_image_size;
	
}
add_filter( 'woocommerce_get_image_size_shop_single', 'yourtheme_woocommerce_image_dimensions' ); 	// Single image height

function mt_soundstage_single_product_large_thumbnail_size(){
	return 'shop_single_image_size';
}
//add_filter('single_product_large_thumbnail_size', 'mt_soundstage_single_product_large_thumbnail_size');