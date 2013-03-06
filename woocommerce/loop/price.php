<?php
/**
 * Loop Price
 */

global $product;
?>

<?php if ( $price_html = $product->get_price_html() ) : ?>
	<span class="price sticker"><?php echo $price_html; ?></span>
<?php endif; ?>