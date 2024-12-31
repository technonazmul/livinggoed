<div class="form-group">
	<label for="prop_label">
		<?php echo houzez_option('cl_price_postfix', 'After The Price Label') . houzez_required_field('price_label'); ?>
	</label>

	<select class="form-control" name="prop_label" <?php houzez_required_field_2('price_label'); ?> id="prop_label">
		<optgroup label="For Sale Price">
			<option>k.k.</option>
			<option>v.o.n.</option>
		</optgroup>
		<optgroup label="For Rental Price">
			<option>per maand</option>
			<option>Per year</option>
			<option>m² /jaar</option>
		</optgroup>
	</select>

	<small class="form-text text-muted"><?php echo houzez_option('cl_price_postfix_tooltip', 'For example: Monthly'); ?></small>
</div>
