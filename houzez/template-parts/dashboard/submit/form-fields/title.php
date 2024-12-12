<?php
$property_title_limit = houzez_option('property_title_limit');
$enable_title_limit = houzez_option('enable_title_limit', 0);

$length = '';
$is_limit = false;
if( $enable_title_limit == 1 && $property_title_limit != '' ) {
	$is_limit = true;
	$length = 'maxlength="'.esc_attr($property_title_limit).'"';
}
?>
<div class="menu-edit-property-wrap">

    <div class="property-author-wrap">
    <label>Select Lead</label>
   
    <select name="lead_id" id="property-author-js" class="selectpicker form-control property-lead-js" data-live-search="true" data-size="5">
        <?php get_all_leads_template(); ?>
    </select>
</div>

<div class="form-group">
	<label for="prop_title"><?php echo houzez_option('cl_prop_title', 'Property Title').houzez_required_field('title'); ?></label>

	<?php if( $is_limit ) { ?>
	<div class="title-counter"><span id="rchars">0</span><span> / <?php echo esc_attr($property_title_limit); ?></span></div>
	<?php } 
	
	if (houzez_edit_property()) {
        global $property_data;
        
		print_r($property_data);
        
    }
	?>
	

	<input class="form-control" <?php houzez_required_field_2('title'); ?> name="prop_title" id="prop_title" value="<?php
    if (houzez_edit_property()) {
        global $property_data;
        echo esc_attr($property_data->post_title);
        echo esc_attr($property_data->lead_id);
        
    }
    ?>" placeholder="<?php echo houzez_option('cl_prop_title_plac', 'Enter your property title'); ?>" <?php echo $length; ?> type="text">
</div>