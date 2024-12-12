<?php
if (!defined('ABSPATH')) exit;

// Fetch lead details
function houzez_crm_fetch_lead_details() {
    $lead_id = intval($_POST['lead_id']);
    $details = houzez_crm_get_lead_details($lead_id);

    if ($details) {
        wp_send_json_success([
            'name' => $details['lead']->name,
            'email' => $details['lead']->email,
            'phone' => $details['lead']->phone,
            'comments' => $details['comments']
        ]);
    } else {
        wp_send_json_error('Lead not found.');
    }
}
add_action('wp_ajax_get_lead_details', 'houzez_crm_fetch_lead_details');

// Add a comment
function houzez_crm_add_new_comment() {
    $lead_id = intval($_POST['lead_id']);
    $comment = sanitize_text_field($_POST['comment']);

    houzez_crm_add_comment($lead_id, $comment);
    wp_send_json_success('Comment added successfully.');
}
add_action('wp_ajax_add_comment', 'houzez_crm_add_new_comment');
?>
