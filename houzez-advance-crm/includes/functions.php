<?php
if (!defined('ABSPATH')) exit;

if (!function_exists('crm_matched_listings')) {
    function crm_matched_listings($meta) {
        if (empty($meta)) {
            return '';
        }
        $meta = maybe_unserialize($meta);
        $tax_query = array();
        $meta_query = array();

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $args = array(
            'post_type' => 'property',
            'posts_per_page' => 15,
            'paged' => $paged,
            'author' => get_current_user_id(),
            'post_status' => 'publish'
        );

        // Taxonomies
        $tax_query = apply_filters('crm_tax_crm_filter', $tax_query, $meta);
        $tax_count = count($tax_query);
        if ($tax_count > 1) {
            $tax_query['relation'] = 'AND';
        }

        if ($tax_count > 0) {
            $args['tax_query'] = $tax_query;
        }

        // Meta
        $meta_query = apply_filters('crm_meta_crm_filter', $meta_query, $meta);
        $meta_count = count($meta_query);
        if ($meta_count > 1) {
            $meta_query['relation'] = 'AND';
        }

        if ($meta_count > 0) {
            $args['meta_query'] = $meta_query;
        }

        $query = new WP_Query($args);
        return $query;
    }
}

if (!function_exists('crm_filter_by_property_type')) {
    function crm_filter_by_property_type($tax_query, $meta) {
        if (isset($meta['property_type']['slug']) && !empty($meta['property_type']['slug'])) {
            $tax_query[] = array(
                'taxonomy' => 'property_type',
                'field' => 'slug',
                'terms' => $meta['property_type']['slug']
            );
        }
        return $tax_query;
    }

    add_filter('crm_tax_crm_filter', 'crm_filter_by_property_type', 10, 2);
}

if (!function_exists('crm_filter_by_property_status')) {
    function crm_filter_by_property_status($tax_query, $meta) {
        if (isset($meta['property_status']['slug']) && !empty($meta['property_status']['slug'])) {
            $tax_query[] = array(
                'taxonomy' => 'property_status',
                'field' => 'slug',
                'terms' => $meta['property_status']['slug']
            );
        }
        return $tax_query;
    }

    add_filter('crm_tax_crm_filter', 'crm_filter_by_property_status', 10, 2);
}

if (!function_exists('crm_filter_by_country')) {
    function crm_filter_by_country($tax_query, $meta) {
        if (isset($meta['country']['slug']) && !empty($meta['country']['slug'])) {
            $tax_query[] = array(
                'taxonomy' => 'property_country',
                'field' => 'slug',
                'terms' => $meta['country']['slug']
            );
        }
        return $tax_query;
    }

    add_filter('crm_tax_crm_filter', 'crm_filter_by_country', 10, 2);
}

if (!function_exists('crm_filter_by_state')) {
    function crm_filter_by_state($tax_query, $meta) {
        if (isset($meta['state']['slug']) && !empty($meta['state']['slug'])) {
            $tax_query[] = array(
                'taxonomy' => 'property_state',
                'field' => 'slug',
                'terms' => $meta['state']['slug']
            );
        }
        return $tax_query;
    }

    add_filter('crm_tax_crm_filter', 'crm_filter_by_state', 10, 2);
}

if (!function_exists('crm_filter_by_city')) {
    function crm_filter_by_city($tax_query, $meta) {
        if (isset($meta['city']['slug']) && !empty($meta['city']['slug'])) {
            $tax_query[] = array(
                'taxonomy' => 'property_city',
                'field' => 'slug',
                'terms' => $meta['city']['slug']
            );
        }
        return $tax_query;
    }

    add_filter('crm_tax_crm_filter', 'crm_filter_by_city', 10, 2);
}

if (!function_exists('crm_filter_by_area')) {
    function crm_filter_by_area($tax_query, $meta) {
        if (isset($meta['area']['slug']) && !empty($meta['area']['slug'])) {
            $tax_query[] = array(
                'taxonomy' => 'property_area',
                'field' => 'slug',
                'terms' => $meta['area']['slug']
            );
        }
        return $tax_query;
    }

    add_filter('crm_tax_crm_filter', 'crm_filter_by_area', 10, 2);
}

if (!function_exists('crm_filter_by_price')) {
    function crm_filter_by_price($meta_query, $meta) {
        if (isset($meta['min_price']) && isset($meta['max_price'])) {
            $min_price = doubleval(houzez_clean($meta['min_price']));
            $max_price = doubleval(houzez_clean($meta['max_price']));

            if ($min_price > 0 && $max_price >= $min_price) {
                $meta_query[] = array(
                    'key' => 'fave_property_price',
                    'value' => array($min_price, $max_price),
                    'type' => 'NUMERIC',
                    'compare' => 'BETWEEN',
                );
            }
        }
        return $meta_query;
    }

    add_filter('crm_meta_crm_filter', 'crm_filter_by_price', 10, 2);
}

if (!function_exists('crm_filter_by_bedrooms')) {
    function crm_filter_by_bedrooms($meta_query, $meta) {
        if (isset($meta['bedrooms']) && !empty($meta['bedrooms'])) {
            $meta_query[] = array(
                'key' => 'fave_property_bedrooms',
                'value' => $meta['bedrooms'],
                'type' => 'NUMERIC',
                'compare' => '='
            );
        }
        return $meta_query;
    }

    add_filter('crm_meta_crm_filter', 'crm_filter_by_bedrooms', 10, 2);
}

if (!function_exists('crm_filter_by_bathrooms')) {
    function crm_filter_by_bathrooms($meta_query, $meta) {
        if (isset($meta['bathrooms']) && !empty($meta['bathrooms'])) {
            $meta_query[] = array(
                'key' => 'fave_property_bathrooms',
                'value' => $meta['bathrooms'],
                'type' => 'NUMERIC',
                'compare' => '='
            );
        }
        return $meta_query;
    }

    add_filter('crm_meta_crm_filter', 'crm_filter_by_bathrooms', 10, 2);
}

if (!function_exists('crm_filter_by_garages')) {
    function crm_filter_by_garages($meta_query, $meta) {
        if (isset($meta['garages']) && !empty($meta['garages'])) {
            $meta_query[] = array(
                'key' => 'fave_property_garages',
                'value' => $meta['garages'],
                'type' => 'NUMERIC',
                'compare' => '='
            );
        }
        return $meta_query;
    }

    add_filter('crm_meta_crm_filter', 'crm_filter_by_garages', 10, 2);
}

if (!function_exists('crm_filter_by_year_built')) {
    function crm_filter_by_year_built($meta_query, $meta) {
        if (isset($meta['year_built']) && !empty($meta['year_built'])) {
            $meta_query[] = array(
                'key' => 'fave_property_year_built',
                'value' => $meta['year_built'],
                'type' => 'NUMERIC',
                'compare' => '='
            );
        }
        return $meta_query;
    }

    add_filter('crm_meta_crm_filter', 'crm_filter_by_year_built', 10, 2);
}

// Function to fetch leads from the database
function houzez_crm_get_leads() {
    global $wpdb;
    $leads_table = $wpdb->prefix . 'houzez_crm_leads';
    return $wpdb->get_results("SELECT * FROM $leads_table");
}



// Function to fetch matched data for a lead
function houzez_crm_get_matched_data($lead_id) {
    global $wpdb;
    $enquiries_table = $wpdb->prefix . 'houzez_crm_enquiries';
    $enquiries = $wpdb->get_results($wpdb->prepare("SELECT * FROM $enquiries_table WHERE lead_id = %d", $lead_id));
    
    // Example: Iterate through each enquiry and fetch matches
    $matched_data = [];
    foreach ($enquiries as $enquiry) {
        $matched_query = crm_matched_listings($enquiry->enquiry_meta); // Assuming this function exists
        while ($matched_query->have_posts()) {
            $matched_query->the_post();
            $matched_data[] = [
                'title' => get_the_title(),
                'price' => get_post_meta(get_the_ID(), 'fave_property_price', true),
                'url' => get_permalink(),
            ];
        }
        wp_reset_postdata();
    }
    return $matched_data;
}


?>