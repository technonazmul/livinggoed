<?php
$lead = $first_name = $last_name = '';
if(isset($_GET['lead-id'])) {

	$lead_id = isset($_GET['lead-id']) ? intval($_GET['lead-id']) : 0;
	
	$lead = Houzez_Leads::get_lead($lead_id);

	$prefix = $lead->prefix;
	$display_name = $lead->display_name;
	$first_name = $lead->first_name;
	$last_name = $lead->last_name;
	$email = $lead->email;
	$type = $lead->type;
	$mobile = $lead->mobile;
	$work_phone = $lead->work_phone;
	$home_phone = $lead->home_phone;
	$address = $lead->address;
	$country = $lead->country;
	$state = $lead->state;
	$city = $lead->city;
	$zipcode = $lead->zipcode;
	$enquiry_to = $lead->enquiry_to;
	$source = $lead->source;
	$source_link = $lead->source_link;
	$message = $lead->message;
	$enquiry_user_type = $lead->enquiry_user_type;
	$facebook_url = $lead->facebook_url;
	$twitter_url = $lead->twitter_url;
	$linkedin_url = $lead->linkedin_url;
	$private_note = $lead->private_note;

	$agent_info = houzezcrm_get_assigned_agent( $enquiry_to, $enquiry_user_type );
	
} 

if( !empty($lead) ) :
	global $wpdb;

    // Table name
    $table_name = $wpdb->prefix . 'houzez_crm_activities';

    // Query to find the row with the specific email in metadata
    $activity = $wpdb->get_row(
        $wpdb->prepare(
            "SELECT meta FROM $table_name WHERE meta LIKE %s ORDER BY activity_id  DESC LIMIT 1",
            '%' . $wpdb->esc_like($lead->email) . '%'
        )
    );

    if ($activity) {
        // Unserialize the metadata
        $meta_data = maybe_unserialize($activity->meta);

        if (isset($meta_data['listing_id'])) {
            $listing_id = $meta_data['listing_id'];

            // Get permalink for the listing_id
            $permalink = get_permalink($listing_id);

           
        } 
    } 
?>
<div class="lead-detail-wrap">
	<h2><?php if($prefix) { echo $prefix.'. '; } echo esc_attr($display_name); ?></h2>


	<ul class="list-unstyled mb-5">
		<?php if(!empty($first_name)) { ?>
		<li>
			<strong><?php esc_html_e('First Name', 'houzez'); ?></strong><br>
			<?php echo esc_attr($first_name); ?>
		</li>
		<?php } ?>

		<?php if(!empty($last_name)) { ?>
		<li>
			<strong><?php esc_html_e('Last Name', 'houzez'); ?></strong><br>
			<?php echo esc_attr($last_name); ?>
		</li>
		<?php } ?>

		<li>
			<strong><?php esc_html_e('Email', 'houzez'); ?></strong><br>
			<a href="mailto:<?php echo esc_attr($email); ?>"><strong><?php echo esc_attr($email); ?></strong></a>
		</li>

		<?php if($type) { ?>
		<li>
			<strong><?php esc_html_e('Type', 'houzez'); ?></strong><br>
			<?php 
            $type = stripslashes($type);
            $type = htmlentities($type);
            echo esc_attr($type); ?>
		</li>
		<?php } ?>

		<?php if($message) { ?>
		<li>
			<strong><?php esc_html_e('Message', 'houzez'); ?></strong><br>
			<?php echo ($message); ?>
		</li>
		<?php } ?>
	</ul>
	<h2><?php esc_html_e('Details', 'houzez'); ?></h2>
	<ul class="list-unstyled mb-5">
		
		<?php if($address) { ?>
		<li>
			<strong><?php esc_html_e('Address', 'houzez'); ?></strong><br>
			<?php echo esc_attr($address); ?>
		</li>
		<?php } ?>

		<?php if($mobile) { ?>
		<li>
			<strong><?php esc_html_e('Mobile', 'houzez'); ?></strong><br>
			<?php echo esc_attr($mobile); ?>
		</li>
		<?php } ?>

		<?php if($home_phone) { ?>
		<li>
			<strong><?php esc_html_e('Home', 'houzez'); ?></strong><br>
			<?php echo esc_attr($home_phone); ?>
		</li>
		<?php } ?>

		<?php if($work_phone) { ?>
		<li>
			<strong><?php esc_html_e('Work', 'houzez'); ?></strong><br>
			<?php echo esc_attr($work_phone); ?>
		</li>
		<?php } ?>

		<?php if($country || $city || $state) { ?>
		<li>
			<strong><?php esc_html_e('Location', 'houzez'); ?></strong><br>
			<?php 
				echo esc_attr($country);
				if($state) {
					echo ', '.$state;
				} 
				if($city) {
					echo ', '.$city;
				} 
				if($zipcode) {
					echo ', '.$zipcode;
				} 
			?>

		</li>
		<?php } ?>

		<li style="overflow: hidden;">
			<strong><?php esc_html_e('Source', 'houzez'); ?></strong><br>
			<?php 
			if( !empty($source) || !empty($source_link)) {

				if( !empty($source)) {
					echo esc_attr($source).'<br/>';
				}

				if(!empty($source_link)) {
					echo '<a href="'.esc_url($source_link).'">'.esc_url($source_link).'</a>';
				}
			} 

			if(isset($permalink)) {
				echo '<a href="'.esc_url($permalink).'">'.esc_url($permalink).'</a>';
			}
			?>
			
			
		</li>
		<li>
			<strong><?php esc_html_e('Private Note', 'houzez'); ?></strong><br>
			<?php 
			if( !empty($private_note) ) {

				echo ($private_note);
			} 
			?>
			
		</li>
	</ul>

	<h2><?php esc_html_e('Realtor', 'houzez'); ?></h2>
	<ul class="list-unstyled mb-5">
		<li>
			<strong><?php esc_html_e('Name', 'houzez'); ?></strong><br>
			<?php 
			if(!empty($agent_info['name'])) {
				echo esc_attr($agent_info['name']);
			} else {
				echo '-';
			}
			?>

		</li>
		<li>
			<strong><?php esc_html_e('Email', 'houzez'); ?></strong><br>
			<?php 
			if(!empty($agent_info['email'])) {
				echo '<a href="mailto:'.esc_attr($agent_info['email']).'"><strong>'.esc_attr($agent_info['email']).'</strong></a>';
			} else {
				echo '-';
			}
			?>
		</li>
	</ul>

	<?php
	if( $facebook_url != '' || $twitter_url != '' || $linkedin_url != '' ) { ?>
	<h2><?php esc_html_e('Social', 'houzez'); ?></h2>
	<ul class="list-unstyled mb-5">
		<?php
		if( $facebook_url != '' ) { ?>
		<li>
			<a href="<?php echo esc_url($facebook_url); ?>"><strong><?php esc_html_e('Facebook', 'houzez'); ?></strong></a>
		</li>
		<?php } 
		if( $twitter_url != '' ) { ?>
		<li>
			<a href="<?php echo esc_url($twitter_url); ?>"><strong><?php esc_html_e('Twitter', 'houzez'); ?></strong></a>
		</li>
		<?php } 
		if( $linkedin_url != '' ) { ?>
		<li>
			<a href="<?php echo esc_url($linkedin_url); ?>"><strong><?php esc_html_e('Linkedin', 'houzez'); ?></strong></a>
		</li>
		<?php } ?>
	</ul>
	<?php } ?>
</div><!-- lead-detail-wrap -->
<?php endif; ?>