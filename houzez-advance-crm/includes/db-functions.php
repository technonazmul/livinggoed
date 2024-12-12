<?php
if (!defined('ABSPATH')) exit;

// Fetch leads data
function houzez_crm_get_leads_data() {
    global $wpdb;
    $table = $wpdb->prefix . 'houzez_crm_leads';
    return $wpdb->get_results("SELECT * FROM $table");
}

// Fetch details of a single lead
function houzez_crm_get_lead_details($lead_id) {
    global $wpdb;
    $leads_table = $wpdb->prefix . 'houzez_crm_leads';
    $enquiries_table = $wpdb->prefix . 'houzez_crm_enquiries';

    $lead = $wpdb->get_row($wpdb->prepare("SELECT * FROM $leads_table WHERE id = %d", $lead_id));
    $comments = $wpdb->get_results($wpdb->prepare("SELECT * FROM $enquiries_table WHERE lead_id = %d", $lead_id));

    return ['lead' => $lead, 'comments' => $comments];
}

// Add a comment to the database
function houzez_crm_add_comment($lead_id, $comment) {
    global $wpdb;
    $table = $wpdb->prefix . 'houzez_crm_enquiries';

    $wpdb->insert($table, [
        'lead_id' => $lead_id,
        'comment' => sanitize_text_field($comment),
        'created_at' => current_time('mysql')
    ]);
}
?>
