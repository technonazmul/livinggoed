<?php
if (!defined('ABSPATH')) exit;

// Enqueue Bootstrap and custom plugin assets
function houzez_advance_crm_enqueue_assets() {
    // Bootstrap CSS
    wp_enqueue_style('bootstrap-css', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css', [], '5.3.0');

    // Bootstrap JS
    wp_enqueue_script('bootstrap-js', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js', ['jquery'], '5.3.0', true);

    // Custom CSS and JS
    wp_enqueue_style('houzez-crm-styles', plugins_url('../assets/css/crm.css', __FILE__));
    wp_enqueue_script('houzez-crm-scripts', plugins_url('../assets/js/crm.js', __FILE__), ['jquery'], '1.0', true);

    // Add AJAX URL for JavaScript
    wp_localize_script('houzez-crm-scripts', 'houzezCRM', [
        'ajaxurl' => admin_url('admin-ajax.php'),
    ]);
}
add_action('admin_enqueue_scripts', 'houzez_advance_crm_enqueue_assets');
?>
