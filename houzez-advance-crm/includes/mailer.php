<?php
if (!defined('ABSPATH')) exit;

// Send an email to a lead with their matched data
function houzez_crm_send_email_to_lead($lead, $matched_data) {
    $to = $lead->email;
    $subject = "Your Matching Properties";
    $headers = ['Content-Type: text/html; charset=UTF-8'];

    // Email content
    $message = "<h1>Matching Properties for {$lead->display_name}</h1>";
    $message .= "<table border='1' cellpadding='5' cellspacing='0'>";
    $message .= "<tr><th>Title</th><th>Price</th><th>URL</th></tr>";

    foreach ($matched_data as $data) {
        $message .= "<tr>";
        $message .= "<td>{$data['title']}</td>";
        $message .= "<td>" . number_format($data['price']) . "</td>";
        $message .= "<td><a href='{$data['url']}'>View Property</a></td>";
        $message .= "</tr>";
    }

    $message .= "</table>";

    // Send the email
    return wp_mail($to, $subject, $message, $headers);
}
