<?php
global $hide_prop_fields;
$property_price = '';
$show_price_placeholder = 1;
$checked = '';
if (houzez_edit_property()) {
    $property_price = houzez_get_field_meta('property_price');
    $show_price_placeholder = houzez_get_field_meta('show_price_placeholder');
    if( $show_price_placeholder ) {
    	$checked = 'checked';
    }
}
?>
<div class="form-group">
	<label for="prop_price">
		<?php echo houzez_option('cl_sale_price', 'Sale or Rent Price').houzez_required_field('sale_rent_price'); ?>	
	</label>

	<input class="form-control" name="prop_price" <?php houzez_required_field_2('sale_rent_price'); ?> id="prop_price" value="<?php echo esc_attr( $property_price ); ?>" placeholder="<?php echo houzez_option('cl_sale_price_plac', 'Enter the price'); ?>" type="text">

    <?php if( isset( $hide_prop_fields['price_placeholder'] ) && $hide_prop_fields['price_placeholder'] != 1 ) { ?>
    <label class="control control--checkbox hz-price-placeholder">
    	<input type="checkbox" id="show_price_placeholder" name="show_price_placeholder" <?php echo $checked; ?>>
    	<span class="control__indicator"></span>
    	<?php echo houzez_option('cl_show_price_placeholder', 'Enable Price Placeholder'); ?>
    </label>
	<?php } ?>
</div>