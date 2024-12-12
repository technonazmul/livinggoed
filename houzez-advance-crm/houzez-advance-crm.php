<?php
/*
Plugin Name: Houzez Advance CRM
Description: Advanced CRM for the Houzez theme with Bootstrap styling and automated email notifications.
Version: 1.0
Author: Your Name
*/

if (!defined('ABSPATH')) exit; // Prevent direct access

// Include necessary files
require_once plugin_dir_path(__FILE__) . 'includes/db-functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/enqueue-scripts.php';
require_once plugin_dir_path(__FILE__) . 'includes/ajax-handler.php';
require_once plugin_dir_path(__FILE__) . 'includes/render-functions.php'; // Include the render functions
// Include necessary files
require_once plugin_dir_path(__FILE__) . 'includes/functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/mailer.php';
require_once plugin_dir_path(__FILE__) . 'includes/scheduler.php';

// Register hooks
// register_activation_hook(__FILE__, 'houzez_crm_activate');
// register_deactivation_hook(__FILE__, 'houzez_crm_deactivate');

// Add a custom cron schedule for 1 minute
add_filter('cron_schedules', function($schedules) {
    $schedules['one_minute'] = [
        'interval' => 60, // 60 seconds (1 minute)
        'display' => __('Every Minute')
    ];
    return $schedules;
});

// Schedule the custom cron job
// function houzez_crm_activate() {
//     if (!wp_next_scheduled('houzez_crm_send_scheduled_emails')) {
//         wp_schedule_event(time(), 'one_minute', 'houzez_crm_send_scheduled_emails');
//     }
// }

// Clear the cron job on deactivation
// function houzez_crm_deactivate() {
//     wp_clear_scheduled_hook('houzez_crm_send_scheduled_emails');
// }

function houzez_crm_admin_menu() {
    add_menu_page(
        'Houzez Advance CRM', 
        'Houzez Advance CRM', 
        'manage_options', 
        'houzez-crm', 
        'houzez_crm_render_table', 
        'dashicons-businessman', 
        6
    );

    add_submenu_page(
        null, // Hide from the main menu
        'Lead Details', 
        'Lead Details', 
        'manage_options', 
        'houzez-crm-lead-details', 
        'houzez_crm_render_lead_details'
    );
}

add_action('admin_menu', 'houzez_crm_admin_menu');



// Render admin page
function houzez_crm_page() {
    ?>
    <div class="container mt-4">
        <h1>Houzez CRM Dashboard</h1>
        <?php houzez_crm_render_table(); ?>
    </div>
    <?php
}
?>