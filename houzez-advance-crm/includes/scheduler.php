<?php
if (!defined('ABSPATH')) exit;

// Hook into WordPress cron
add_action('houzez_crm_send_scheduled_emails', 'houzez_crm_send_daily_emails');

// Function to send emails to all leads
function houzez_crm_send_daily_emails() {
    $leads = houzez_crm_get_leads(); // Fetch all leads

    foreach ($leads as $lead) {
        $matched_data = houzez_crm_get_matched_data($lead->lead_id); // Fetch matched data
        if (!empty($matched_data)) {
            houzez_crm_send_email_to_lead($lead, $matched_data); // Send email
        }
    }
}

add_action('houzez_crm_send_matched_emails', 'sendSingleLeadsMatchedData',10,1);

function sendSingleLeadsMatchedData($lead_id) {
    global $wpdb;
    
    // Table name
    $leads_table = $wpdb->prefix . 'houzez_crm_leads';
    
    // Fetch the single lead by ID
    $lead = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}houzez_crm_leads WHERE lead_id = %d", $lead_id));
    
    // Check if the lead exists
    if ($lead) {
        // Fetch matched data
        $matched_data = houzez_crm_get_matched_data($lead_id);

        // If matched data exists, send an email
        if (!empty($matched_data)) {
            houzez_crm_send_email_to_lead($lead, $matched_data); // Send email
        } else {
            error_log("No matched data found for lead ID: $lead_id");
        }
    } else {
        error_log("No lead found with ID: $lead_id");
    }
}