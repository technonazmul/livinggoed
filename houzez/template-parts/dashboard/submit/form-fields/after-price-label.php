<?php 
global $property_data;
?>

<div class="form-group">
	<label for="prop_label">
		<?php echo houzez_option('cl_price_postfix', 'After The Price Label') . houzez_required_field('price_label'); ?>
	</label>
	
	<?php
		$listing_id = $property_data->ID;
		
		$price_postfix  = get_post_meta( $listing_id, 'fave_property_price_postfix', true );
        $price_prefix  = get_post_meta( $listing_id, 'fave_property_price_prefix', true );
		?>
	<select class="form-control" name="prop_label" <?php houzez_required_field_2('price_label'); ?> id="prop_label">
		
		<optgroup label="For Sale Price">
			<option <?php if($price_postfix == 'k.k'){echo "selected";} ?>>k.k.</option>
			<option <?php if($price_postfix == 'v.o.n.'){echo "selected";} ?>>v.o.n.</option>
		</optgroup>
		<optgroup label="For Rental Price">
			<option <?php if($price_postfix == 'per maand'){echo "selected";} ?>>per maand</option>
			<option <?php if($price_postfix == 'Per year'){echo "selected";} ?>>Per year</option>
			<option <?php if($price_postfix == 'm² /jaar'){echo "selected";} ?>>m² /jaar</option>
		</optgroup>
	</select>

	<small class="form-text text-muted"><?php echo houzez_option('cl_price_postfix_tooltip', 'For example: Monthly'); ?></small>
</div>
