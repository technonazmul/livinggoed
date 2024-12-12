<?php
global $post, $current_user;
$return_array = houzez20_property_contact_form();
if(empty($return_array)) {
    return;
}
$terms_page_id = houzez_option('terms_condition');
$terms_page_id = apply_filters( 'wpml_object_id', $terms_page_id, 'page', true );
$agent_display = houzez_get_listing_data('agent_display_option');

$schedule_time_slots = houzez_option('schedule_time_slots');
$gdpr_checkbox = houzez_option('gdpr_hide_checkbox', 1);
$schedule_num_days = houzez_option('schedule_num_days', 14);
$agent_email = is_email( $return_array['agent_email'] );

if ($agent_email && $agent_display != 'none') { 

if(houzez_form_type()) {

    echo '<div class="property-form-wrap">';
        
        if(!empty(houzez_option('schedule_tour_shortcode'))) {
            echo do_shortcode(houzez_option('schedule_tour_shortcode'));
        }
    echo '</div>';

} else { 
?>
<form method="post" action="#">

    <input type="hidden" name="schedule_contact_form_ajax"
       value="<?php echo wp_create_nonce('schedule-contact-form-nonce'); ?>"/>
    <input type="hidden" name="property_permalink"
           value="<?php echo esc_url(get_permalink($post->ID)); ?>"/>
    <input type="hidden" name="property_title"
           value="<?php echo esc_attr(get_the_title($post->ID)); ?>"/>
    <input type="hidden" name="action" value="houzez_schedule_send_message">

    <input type="hidden" name="listing_id" value="<?php echo intval($post->ID)?>">
    <input type="hidden" name="is_listing_form" value="yes">
    <input type="hidden" name="is_schedule_form" value="yes">
    <input type="hidden" name="agent_id" value="<?php echo intval($return_array['agent_id'])?>">
    <input type="hidden" name="agent_type" value="<?php echo esc_attr($return_array['agent_type'])?>">

    <input type="hidden" name="target_email" value="<?php echo antispambot($agent_email); ?>">
    <div class="property-schedule-tour-form-wrap">
        <div class="property-schedule-tour-day-form">
            <div class="tour-day-form-slide-arrow next sche-tabs-next-js">
                <i class="houzez-icon icon-arrow-right-1"></i>
            </div>
            <div class="tour-day-form-slide-arrow prev sche-tabs-prev-js">
                <i class="houzez-icon icon-arrow-left-1"></i>
            </div>
            <div class="property-schedule-tour-day-form-slide-wrap">
                <div class="property-schedule-tour-day-form-slide-v2">
                    
                    <?php
                    $m = date("m"); // Current month
                    $de = date("d"); // Current day
                    $y = date("Y"); // Current year

                    $schedule_num_days = intval($schedule_num_days);

                    if (!$schedule_num_days) {
                        $schedule_num_days = 14; // Set default to 14 if not specified or invalid
                    }

                    // Adjust $i <= 20 for 21 days range (0 to 20 equals 21 days)
                    for($i = 0; $i <= $schedule_num_days; $i++) { 

                        $day = date_i18n('D', mktime(0, 0, 0, $m, ($de + $i), $y)); 
                        $day_number = date_i18n('d', mktime(0, 0, 0, $m, ($de + $i), $y));
                        $month = date_i18n('M', mktime(0, 0, 0, $m, ($de + $i), $y));
                    ?>
                        <div class="hz-date-item">
                            <div class="form-group">
                                <label class="control control--radio">
                                    <input name="schedule_date" type="radio" value="<?php echo $day.' '.$day_number.' '.$month; ?>">
                                    <span class="control__indicator">
                                        <?php echo $day ?><br>
                                        <span class="control__indicator_day"><?php echo $day_number ?></span><br>
                                        <?php echo $month ?>
                                    </span>
                                </label>
                            </div>
                        </div>

                    <?php
                        }
                    ?>
        
                </div>
            </div>
        </div>

        <div class="property-schedule-tour-form-title"><?php echo houzez_option('spl_con_tour_type', 'Tour Type'); ?></div>
        
        <div class="property-schedule-tour-type-form d-flex justify-content-between">
            <div class="form-group">
                <label class="control control--radio">
                <input name="schedule_tour_type" type="radio" checked value="<?php echo houzez_option('spl_con_in_person', 'In Person'); ?>">
                <span class="control__indicator"><?php echo houzez_option('spl_con_in_person', 'In Person'); ?></span>
                </label>
            </div>
            <!-- form-group -->
            <div class="form-group">
                <label class="control control--radio">
                <input name="schedule_tour_type" type="radio" value="<?php echo houzez_option('spl_con_video_chat', 'Video Chat'); ?>">
                <span class="control__indicator"><?php echo houzez_option('spl_con_video_chat', 'Video Chat'); ?></span>
                </label>
            </div>
            <!-- form-group -->
        </div>
        <div class="form-group">
            <select name="schedule_time" class="selectpicker form-control bs-select-hidden" title="<?php echo houzez_option('spl_con_time', 'Choose a time'); ?>" data-live-search="false">
                <?php 
                $time_slots = explode(',', $schedule_time_slots); 
                foreach ($time_slots as $time) {
                    echo '<option value="'.trim($time).'">'.esc_attr($time).'</option>';
                }
                ?> 
            </select>
            <!-- selectpicker -->
        </div>
        <div class="form-group">
            <input class="form-control" name="name" placeholder="<?php echo houzez_option('spl_con_name', 'Name'); ?>" type="text">
        </div>

        <div class="form-group">
            <input class="form-control" name="phone" placeholder="<?php echo houzez_option('spl_con_phone', 'Phone'); ?>" type="text">
        </div>

        <div class="form-group">
            <input class="form-control" name="email" placeholder="<?php echo houzez_option('spl_con_email', 'Email'); ?>" type="email">
        </div>

        <div class="form-group">
            <textarea class="form-control" name="message" rows="3" placeholder="<?php echo houzez_option('spl_con_message_plac', 'Message'); ?>"></textarea>
        </div>

        <?php do_action('houzez_schedule_tour_fields'); ?>
        
        <?php if( houzez_option('gdpr_and_terms_checkbox', 1) ) { ?>
        <div class="form-group form-group-terms">
            <label class="control control--checkbox <?php if( $gdpr_checkbox ){ echo 'hz-no-gdpr-checkbox';}?>">
                <?php if( ! $gdpr_checkbox ) { ?>
                <input type="checkbox" name="privacy_policy">
                <span class="control__indicator"></span>
                <?php } ?>
                <div class="gdpr-text-wrap">
                    <?php echo houzez_option('spl_sub_agree', 'By submitting this form I agree to'); ?> <a target="_blank" href="<?php echo esc_url(get_permalink($terms_page_id)); ?>"><?php echo houzez_option('spl_term', 'Terms of Use'); ?></a>
                </div>
            </label>
        </div><!-- form-group -->
        <?php } ?>
        <div class="form_messages"></div>
        <button class="schedule_contact_form houzez-ele-button btn btn-secondary btn-full-width">
            <?php get_template_part('template-parts/loader'); ?>
            <?php echo houzez_option('spl_btn_tour_sch', 'Submit a Tour Request'); ?> 
        </button>
    </div>
</form>
<?php } 
}?>