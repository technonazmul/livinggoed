<?php
if (!defined('ABSPATH')) exit; // Prevent direct access

// Action to send an email on comment addition
function houzez_crm_send_comment_email($lead_email, $comment) {
    wp_mail($lead_email, 'New Comment Added to Your Lead', $comment);
}