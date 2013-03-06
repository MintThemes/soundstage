<?php
/**
 * Single Product Meta
 */

global $post, $product;
?>
<div class="product_meta">

	<div class="row">	
		<?php echo $product->get_categories( ', ', ' <label>' . __('Category:', 'woocommerce') . '</label><span class="value-text">', '.</span>'); ?>
	</div>

</div>