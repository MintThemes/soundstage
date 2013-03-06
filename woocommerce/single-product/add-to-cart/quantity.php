<?php
/**
 * Single Product Quantity Inputs
 */
?>
<label><?php _e( 'Quantity', 'woocommerce' ); ?></label>
<div class="input-number quantity">
	<input name="<?php echo $input_name; ?>" data-min="<?php echo $min_value; ?>" data-max="<?php echo $max_value; ?>" value="<?php echo $input_value; ?>" size="4" title="Qty" class="input-text qty text" maxlength="12" />
</div>