<?php

/**
 * Get template part for houzez-theme-functinality plugin.
 *
 * @access public
 *
 * @param string $name Template name (default: '').
 * @param mixed $slug Template slug.
 */
function htf_get_template_part( $slug, $name = '' ) {
    $template = '';

    // Get slug-name.php.
    if ( ! $template && $name && file_exists( HOUZEZ_PLUGIN_DIR . "/{$slug}-{$name}.php" ) ) {
        $template = HOUZEZ_PLUGIN_DIR . "/{$slug}-{$name}.php";
    }

    // Get slug.php.
    if ( ! $template && file_exists( HOUZEZ_PLUGIN_DIR . "/{$slug}.php" ) ) {
        $template = HOUZEZ_PLUGIN_DIR . "/{$slug}.php";
    }

    // filter for third party plugins
    $template = apply_filters( 'htf_get_template_part', $template, $slug, $name );

    if ( $template ) {
        load_template( $template, false );
    }
}

if( !function_exists('houzez_get_client_ip')) {
    function houzez_get_client_ip() {
        $server_ip_keys = [
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR',
        ];

        foreach ( $server_ip_keys as $key ) {
            if ( isset( $_SERVER[ $key ] ) && filter_var( $_SERVER[ $key ], FILTER_VALIDATE_IP ) ) {
                return $_SERVER[ $key ];
            }
        }

        // Fallback local ip.
        return '127.0.0.1';
    }
}

if(!function_exists('houzez_get_site_domain')) {
    function houzez_get_site_domain() {
        return str_ireplace( 'www.', '', parse_url( home_url(), PHP_URL_HOST ) );
    }
}

if( !function_exists('houzez_search_builder_custom_field_elementor')) {
    function houzez_search_builder_custom_field_elementor () {
        $fields_array = array();
        if(class_exists('Houzez_Fields_Builder')) {
            $fields = Houzez_Fields_Builder::get_search_fields();

            if(!empty($fields)) {
                foreach ( $fields as $value ) {
                    $field_title = $value->label;
                    $field_name = $value->field_id;
                    
                    $fields_array[$field_name] = $field_title; 
                }
            }
        }

        return $fields_array;
    }
}

if( !function_exists('houzez_get_custom_field_for_elementor')) {
    function houzez_get_custom_field_for_elementor () {
        $fields_array = array();
        if(class_exists('Houzez_Fields_Builder')) {
            $fields = Houzez_Fields_Builder::get_form_fields();

            if(!empty($fields)) {
                foreach ( $fields as $value ) {
                    $field_title = $value->label;
                    $field_name = $value->field_id;
                    
                    $fields_array[$field_name] = $field_title; 
                }
            }
        }

        return $fields_array;
    }
}

if( !function_exists('houzez_custom_field_by_id_elementor')) {
    function houzez_custom_field_by_id_elementor ($field_id) {
        if(class_exists('Houzez_Fields_Builder')) {
            $result = Houzez_Fields_Builder::get_field_by_slug($field_id);

            if( !empty($result)) {
                return $result;
            }
        }

        return false;
    }
}



 /*------------------------------------------------
 * Properties Meta Fields for rest API
 *----------------------------------------------- */
if( !function_exists('houzez_property_rest_api_field')) {
    add_action( 'rest_api_init', 'houzez_property_rest_api_field' );

    function houzez_property_rest_api_field() {
        register_rest_field( 'property', 'property_meta', array(
            'get_callback' => 'houzez_get_rest_api_property_meta'
        ) );
    }

    function houzez_get_rest_api_property_meta( $object ) {
        $post_id = $object['id'];
        $property_meta = get_post_meta( $post_id );

        // add filter
        $property_meta = apply_filters( 'houzez_property_rest_api_meta', $property_meta );

        // return meta
        return $property_meta;
    }
}

/*------------------------------------------------
 * Agents Meta Fields for rest API
 *----------------------------------------------- */
if( !function_exists('houzez_agent_rest_api_field')) {
    add_action( 'rest_api_init', 'houzez_agent_rest_api_field' );

    function houzez_agent_rest_api_field() {
        register_rest_field( 'houzez_agent', 'agent_meta', array(
            'get_callback' => 'houzez_get_rest_api_agent_meta'
        ) );
    }

    function houzez_get_rest_api_agent_meta( $object ) {
        $post_id = $object['id'];
        $agent_meta = get_post_meta( $post_id );

        // add filter
        $agent_meta = apply_filters( 'houzez_agent_rest_api_meta', $agent_meta );

        // return meta
        return $agent_meta;
    }
}

/*------------------------------------------------
 * Agency Meta Fields for rest API
 *----------------------------------------------- */
if( !function_exists('houzez_agency_rest_api_field')) {
    add_action( 'rest_api_init', 'houzez_agency_rest_api_field' );

    function houzez_agency_rest_api_field() {
        register_rest_field( 'houzez_agency', 'agency_meta', array(
            'get_callback' => 'houzez_get_rest_api_agency_meta'
        ) );
    }

    function houzez_get_rest_api_agency_meta( $object ) {
        $post_id = $object['id'];
        $agency_meta = get_post_meta( $post_id );

        // add filter
        $agency_meta = apply_filters( 'houzez_agency_rest_api_meta', $agency_meta );

        // return meta
        return $agency_meta;
    }
}

/*-----------------------------------------------------------------------------------*/
// Get terms array
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'houzez_get_terms_id_array' ) ) {
    function houzez_get_terms_id_array( $tax_name, &$terms_array ) {
        $tax_terms = get_terms( $tax_name, array(
            'hide_empty' => false,
        ) );
        houzez_add_term_id_children( 0, $tax_terms, $terms_array );
    }
}


if ( ! function_exists( 'houzez_add_term_id_children' ) ) :
    function houzez_add_term_id_children( $parent_id, $tax_terms, &$terms_array, $prefix = '' ) {
        if ( ! empty( $tax_terms ) && ! is_wp_error( $tax_terms ) ) {
            foreach ( $tax_terms as $term ) {
                if ( $term->parent == $parent_id ) {
                    $terms_array[ $term->term_id ] = $prefix . $term->name;
                    houzez_add_term_children( $term->term_id, $tax_terms, $terms_array, $prefix . '- ' );
                }
            }
        }
    }
endif;

if ( ! function_exists( 'houzez_pagination_type' ) ) :
    function houzez_pagination_type() {
        $pagi = array(
            'none' => esc_html__('None', 'houzez-theme-functionality'), 
            'loadmore' => esc_html__('Load More', 'houzez-theme-functionality'), 
            'number' => esc_html__('Number', 'houzez-theme-functionality'),
            'infinite_scroll' => esc_html__('Infinite Scroll', 'houzez-theme-functionality'),
        );  

        return $pagi; 
    }
endif;

if ( ! function_exists( 'houzez_ele_property_status' ) ) :
    function houzez_ele_property_status() {
        $pagi = array(
            'all' => esc_html__('Active & Sold', 'houzez-theme-functionality'),
            'publish' => esc_html__('Active', 'houzez-theme-functionality'), 
            'houzez_sold' => esc_html__('Sold', 'houzez-theme-functionality')
        );  

        return $pagi; 
    }
endif;

if ( ! function_exists( 'houzez_sorting_array' ) ) :
    function houzez_sorting_array() {
        $sorting = array(
            '' => esc_html__('Default', 'houzez-theme-functionality'), 
            'a_title' => esc_html__('Title - ASC', 'houzez-theme-functionality'), 
            'd_title' => esc_html__('Title - DESC', 'houzez-theme-functionality'), 
            'a_price' => esc_html__('Price (Low to High)', 'houzez-theme-functionality'), 
            'd_price' => esc_html__('Price (High to Low)', 'houzez-theme-functionality'),
            'a_date' => esc_html__('Date Old to New', 'houzez-theme-functionality'),
            'd_date' => esc_html__('Date New to Old', 'houzez-theme-functionality'),
            'featured_top' => esc_html__('Featured on Top', 'houzez-theme-functionality'),
            'featured_first_random' => esc_html__('Featured on Top - Randomly', 'houzez-theme-functionality'),
            'random' => esc_html__('Random', 'houzez-theme-functionality')
        );  

        return $sorting; 
    }
endif;

/**
 * Get currency exchange rates.
 */
function Fcc_get_exchange_rates( $currency = 'USD' ) {

    $rates = FCC_Rates::get_rates();
    if ( is_array( $rates ) && $currency != 'USD' ) :

        if ( ! Fcc_currency_exists( $currency ) ) {
            trigger_error(
                esc_html__( 'Base currency to get rates not found in database', 'favethemes-currency-converter' ),
                E_USER_WARNING
            );
            return null;
        }

        $new_rates = array();
        $base_rate = $rates[strtoupper( $currency )];

        while ( $array_key = current( $rates ) ) :
            $key = key( $rates );
            $new_rates[$key] = 1 * $rates[$key] / $base_rate;
            next( $rates );
        endwhile;

        $rates = $new_rates;

    endif;

    return $rates;
}

/**
 * Sends json object for given currency with exchange rates
 */
function Fcc_get_exchange_rates_json( $currency = 'USD' ) {
    $rates = FCC_get_exchange_rates( strtoupper( $currency ) );
    wp_send_json( $rates );
}
add_action( 'wp_ajax_nopriv_get_exchange_rates', 'Fcc_get_exchange_rates_json' );
add_action( 'wp_ajax_get_exchange_rates', 'Fcc_get_exchange_rates_json' );

/**
 * Convert from one currency to another.
 */
function Fcc_convert_currency( $amount = 1, $from = 'USD', $in = 'EUR' ) {

    $rates = FCC_Rates::get_rates();

    $error = $result = '';
    if ( $rates && is_array( $rates ) && count( $rates ) > 100 ) {

        if ( ! Fcc_currency_exists( $from ) OR ! Fcc_currency_exists( $in ) ) {
            trigger_error(
                esc_html__( 'Currency was not exist or found in database.', 'favethemes-currency-converter' ),
                E_USER_WARNING
            );
            $error = true;
        }

        if ( ! is_numeric( $amount ) ) {
            trigger_error(
                esc_html__( 'Amount to covert is not number, it must be number.', 'favethemes-currency-converter' ),
                E_USER_WARNING
            );
            $error = true;
        }

        if ( ! $error === true ) {
            $from   = strtoupper( $from );
            $in     = strtoupper( $in );
            $result = $rates[ $from ] && $rates[ $in ] ? (float) $amount * (float) $rates[ $in ] / (float) $rates[ $from ] : floatval( $amount );
        }

    } else {

        trigger_error(
            __( 'Look like your API is not valid, There was a problem to get currency data from database.', 'favethemes-currency-converter' ),
            E_USER_WARNING
        );

    }

    return $result;
}

/**
 * Get currency exchange rate from one to another.
 */
function Fcc_get_exchange_rate( $currency, $other_currency ) {
    $currency = strtoupper( $currency );
    $other_currency = strtoupper( $other_currency );
    $rate = $currency == $other_currency ? 1 : Fcc_convert_currency( 1, $currency, $other_currency );
    return $rate;
}

/**
 * Get currencies array
 */
function Fcc_get_currencies() {
    return FCC_Rates::get_currencies();
}

/**
 * Get List of currencies as json object.
 */
function Fcc_get_currencies_json() {
    $currencies = FCC_get_currencies();
    if ( $currencies && is_array( $currencies ) ) {
        wp_send_json( $currencies );
    }
}
add_action( 'wp_ajax_nopriv_fcc_get_currencies', 'Fcc_get_currencies_json' );
add_action( 'wp_ajax_fcc_get_currencies', 'Fcc_get_currencies_json' );

/**
 * Get currency data.
 */
function Fcc_get_currency( $currency_code = 'USD' ) {

    if ( ! is_string( $currency_code ) OR strlen( $currency_code ) != 3 ) {
        trigger_error(
            esc_html__( 'Please pass valid currency code for argument and it must be a string of three characters long', 'favethemes-currency-converter' ),
            E_USER_WARNING
        );
        return null;
    }

    $currency_data = Fcc_get_currencies();

    if ( ! array_key_exists( strtoupper( $currency_code ), $currency_data ) ) {
        trigger_error(
            esc_html__( 'Currency could not be found', 'favethemes-currency-converter' ),
            E_USER_WARNING
        );
        return null;
    }

    return (array) $currency_data[strtoupper( $currency_code )];
}

/**
 * Format currency
 */
function Fcc_format_currency( $amount, $currency_code, $currency_symbol = true, $sup = false ) {

    if ( ! $amount || ! $currency_code OR is_nan( $amount ) )
        return '';

    $currency = Fcc_get_currency( strtoupper( $currency_code ) );

    if ( is_null( $currency ) ){
        return '';
    }


    $currency_decimals = apply_filters('houzez_currency_switcher_decimal_points', $currency['decimals']);

    if ( ! $currency ) {
        $symbol = $currency_symbol == true ? strtoupper( $currency_code ) : '';
        $result = $amount . ' ' . $symbol;
    } else {
        $formatted = number_format( $amount, $currency_decimals, $currency['decimals_sep'], $currency['thousands_sep'] );
        if ( $currency_symbol == false ) {
            $result = $formatted;
        } else {
            if($sup) {
                $currency_symbol = '<sup>'.$currency['symbol'].'</sup>';
            } else {
                $currency_symbol = $currency['symbol'];
            }

            $result = $currency['position'] == 'before' ? $currency_symbol . '' . $formatted : $formatted . '' . $currency_symbol;
        }
    }

    return html_entity_decode( $result );
}

/**
 * Check if currency code exist
 */
function Fcc_currency_exists( $currency_code ) {

    $currencies = Fcc_get_currencies();

    $codes = array();
    if ( $currencies && is_array( $currencies ) ) {
        foreach ( $currencies as $key => $value ) {
            $codes[] = $key;
        }
    }

    return $codes && is_array( $codes ) ? in_array( strtoupper( $currency_code ), (array) $codes ) : null;
}

if ( ! function_exists( 'houzez_get_current_currency' ) ) {
    
    function houzez_get_current_currency() {

        if ( isset( $_COOKIE['houzez_set_current_currency'] ) && Fcc_currency_exists( $_COOKIE['houzez_set_current_currency'] ) ) { 
            $current_currency = $_COOKIE['houzez_set_current_currency']; // phpcs:ignore
        } else {
            $current_currency = htf_get_base_currency();
        }

        return strtoupper( $current_currency );
    }
}

if ( ! function_exists( 'htf_get_base_currency' ) ) {

    function htf_get_base_currency() {

        $default_currency = houzez_option('houzez_base_currency');
        if ( !empty( $default_currency ) ) {
            return $default_currency;
        } else {
            $default_currency = 'USD';
        }

        return $default_currency;
    }
}

if ( ! function_exists( 'houzez_get_plain_price' ) ) {
    
    function houzez_get_plain_price($amount) {

        if ( empty( $amount ) || is_nan( $amount ) ) {
            return '';
        }

        if ( isset( $_COOKIE['houzez_set_current_currency'] ) ) {
            $formatted_converted_price = houzez_switch_currency_plain( $amount );
            return apply_filters( 'houzez_currency_converted_price', $formatted_converted_price, $amount );
        } else {
            return $amount;
        }

    }
}

if( ! function_exists('houzez_switch_currency_plain') ) {
    function houzez_switch_currency_plain($amount) {

        $base_currency = htf_get_base_currency();
        $current_currency = houzez_get_current_currency();
        $converted_price = Fcc_convert_currency( $amount, $base_currency, $current_currency );

        return apply_filters( 'houzez_switch_currency', $converted_price );

    }
}

if ( ! function_exists( 'houzez_get_terms_array' ) ) {
    function houzez_get_terms_array( $tax_name, &$terms_array ) {
        $tax_terms = get_terms( $tax_name, array(
            'hide_empty' => false,
        ) );
        houzez_add_term_children( 0, $tax_terms, $terms_array );
    }
}


if ( ! function_exists( 'houzez_add_term_children' ) ) :
    function houzez_add_term_children( $parent_id, $tax_terms, &$terms_array, $prefix = '' ) {
        if ( ! empty( $tax_terms ) && ! is_wp_error( $tax_terms ) ) {
            foreach ( $tax_terms as $term ) {
                if ( $term->parent == $parent_id ) {
                    $terms_array[ $term->slug ] = $prefix . $term->name;
                    houzez_add_term_children( $term->term_id, $tax_terms, $terms_array, $prefix . '- ' );
                }
            }
        }
    }
endif;


if(!function_exists('houzez_check_for_taxonomy_plugin')) {
    function houzez_check_for_taxonomy_plugin($tax_setting_name) {

        if(class_exists('Houzez_Taxonomies')) {
            if(Houzez_Taxonomies::get_setting($tax_setting_name) != 'disabled') {
                return true;
            } else {
                return false;
            }
        }

        return true;
    }
}

if(!function_exists('houzez_check_post_types_plugin')) {
    function houzez_check_post_types_plugin($post_type) {

        if(class_exists('Houzez_Post_Type')) {
            if(Houzez_Post_Type::get_setting($post_type) != 'disabled') {
                return true;
            } else {
                return false;
            }
        }

        return true;
    }
}

if(!function_exists('houzez_check_taxonomy')) {
    function houzez_check_taxonomy($tax) {

        if(class_exists('Houzez_Taxonomies')) {
            if(Houzez_Taxonomies::get_setting($tax) != 'disabled') {
                return true;
            } else {
                return false;
            }
        }

        return true;
    }
}

if ( !function_exists( 'houzez_update_recent_colors20' ) ):
    function houzez_update_recent_colors20( $color, $num_col = 10 ) {
        if ( empty( $color ) )
            return false;

        $current = get_option( 'houzez_recent_colors' );
        if ( empty( $current ) ) {
            $current = array();
        }

        $update = false;

        if ( !in_array( $color, $current ) ) {
            $current[] = $color;
            if ( count( $current ) > $num_col ) {
                $current = array_slice( $current, ( count( $current ) - $num_col ), ( count( $current ) - 1 ) );
            }
            $update = true;
        }

        if ( $update ) {
            update_option( 'houzez_recent_colors', $current );
        }

    }
endif;

if ( !function_exists( 'houzez_update_property_status_colors20' ) ):
    function houzez_update_property_status_colors20( $cat_id, $color, $type ) {

        $colors = (array)get_option( 'fave_cat_colors' );

        if ( array_key_exists( $cat_id, $colors ) ) {

            if ( $type == 'inherit' ) {
                unset( $colors[$cat_id] );
            } elseif ( $colors[$cat_id] != $color ) {
                $colors[$cat_id] = $color;
            }

        } else {

            if ( $type != 'inherit' ) {
                $colors[$cat_id] = $color;
            }
        }

        update_option( 'houzez_property_status_colors', $colors );

    }
endif;

if ( !function_exists( 'houzez_update_property_type_colors20' ) ):
    function houzez_update_property_type_colors20( $cat_id, $color, $type ) {

        $colors = (array)get_option( 'fave_cat_colors' );

        if ( array_key_exists( $cat_id, $colors ) ) {

            if ( $type == 'inherit' ) {
                unset( $colors[$cat_id] );
            } elseif ( $colors[$cat_id] != $color ) {
                $colors[$cat_id] = $color;
            }

        } else {

            if ( $type != 'inherit' ) {
                $colors[$cat_id] = $color;
            }
        }

        update_option( 'houzez_property_type_colors', $colors );

    }
endif;


if ( !function_exists( 'houzez_update_property_label_colors20' ) ):
    function houzez_update_property_label_colors20( $cat_id, $color, $type ) {

        $colors = (array)get_option( 'fave_label_colors' );

        if ( array_key_exists( $cat_id, $colors ) ) {

            if ( $type == 'inherit' ) {
                unset( $colors[$cat_id] );
            } elseif ( $colors[$cat_id] != $color ) {
                $colors[$cat_id] = $color;
            }

        } else {

            if ( $type != 'inherit' ) {
                $colors[$cat_id] = $color;
            }
        }

        update_option( 'houzez_property_label_colors', $colors );

    }
endif;

if( ! function_exists( 'houzez_listing_statuses' ) ) {
    function houzez_listing_statuses() {

        $statuses = array(

            'draft' => array(
                'name'  => _x( 'Draft', 'listing post status', 'houzez-theme-functionality' ),
                'label' => _x( 'Draft', 'listing post status', 'houzez-theme-functionality' )
            ),
            'publish' => array(
                'name'  => _x( 'Active', 'listing post status', 'houzez-theme-functionality' ),
                'label' => _x( 'Active', 'listing post status', 'houzez-theme-functionality' )
            ),
            'pending' => array(
                'name'  => _x( 'Pending', 'listing post status', 'houzez-theme-functionality' ),
                'label' => _x( 'Pending approval', 'listing post status', 'houzez-theme-functionality' )
            ),
            'expired' => array(
                'name'  => _x( 'Expired', 'listing post status', 'houzez-theme-functionality' ),
                'label' => _x( 'Expired', 'listing post status', 'houzez-theme-functionality' )
            ),
            'disapproved' => array(
                'name'  => _x( 'Disapproved', 'listing post status', 'houzez-theme-functionality' ),
                'label' => _x( 'Disapproved', 'listing post status', 'houzez-theme-functionality' )
            ),
            'on_hold' => array(
                'name'  => _x( 'On Hold', 'listing post status', 'houzez-theme-functionality' ),
                'label' => _x( 'On Hold', 'listing post status', 'houzez-theme-functionality' )
            ),
            'houzez_sold' => array(
                'name'  => _x( 'Sold', 'listing post status', 'houzez-theme-functionality' ),
                'label' => _x( 'Sold', 'listing post status', 'houzez-theme-functionality' )
            ),
            'preview' => array(
                'name'                      => _x( 'Preview', 'listing post status', 'houzez-theme-functionality' ),
                'label'                     => _x( 'Preview', 'listing post status', 'houzez-theme-functionality' ),
                'public'                    => false,
                'exclude_from_search'       => true,
                'show_in_admin_all_list'    => false,
                'show_in_admin_status_list' => false,
                'label_count'               => _n_noop( 'Preview <span class="count">(%s)</span>', 'Preview <span class="count">(%s)</span>', 'houzez-theme-functionality' )
            ),
            'pending_payment' => array(
                'name'                      => _x( 'Pending', 'listing post status', 'houzez-theme-functionality' ),
                'label'                     => _x( 'Pending payment', 'listing post status', 'houzez-theme-functionality' ),
                'public'                    => true,
                'exclude_from_search'       => true,
                'show_in_admin_all_list'    => true,
                'show_in_admin_status_list' => true,
                'label_count'               => _n_noop( 'Pending Payment <span class="count">(%s)</span>', 'Pending Payment <span class="count">(%s)</span>', 'houzez-theme-functionality' )
            ),
            'trash' => array(
                'name'  => _x( 'Trash', 'listing post status', 'houzez-theme-functionality' ),
                'label' => _x( 'Trash', 'listing post status', 'houzez-theme-functionality' )
            )

        );
        return apply_filters( 'houzez_listing_statuses', $statuses );
    }
}

if( ! function_exists('houzez_get_listing_status') ) {
    /**
     * houzez_get_listing_status()
     *
     * Get specific listing status
     *
     * @param string  $status Key of the corresponding status
     * @param string  $field  Field of the status (default: label)
     * @uses self::statuses()
     * @return array
     *
     * @since 1.0.0
     */
    function houzez_get_listing_status( $status, $field = 'label' ) {

        // Get all available statuses
        $statuses = houzez_listing_statuses();

        if ( isset( $statuses[ $status ][ $field ] ) )
            return $statuses[ $status ][ $field ];

        return false;

    }
}

if(!function_exists('htf_traverse_comma_string')) {
    function htf_traverse_comma_string($string) {
        if(!empty($string)) {
            $string_array = explode(',', $string);
            
            if(!empty($string_array[0])) {
                return $string_array;
            }
        }
        return '';
    }
}

if( !function_exists('houzez_plugin_20')) {
    function houzez_plugin_20($string) {
       $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

       return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }
}

if( !function_exists('houzez_tfp_get_image_placeholder')){
    function houzez_tfp_get_image_placeholder( $featured_image_size ){

        $placeholder_url = houzez_option( 'houzez_placeholder', false, 'url' );

        if ( ! empty( $placeholder_url ) ) {
            $placeholder_image_id = attachment_url_to_postid( $placeholder_url );
            if ( ! empty( $placeholder_image_id ) ) {
                return wp_get_attachment_image( $placeholder_image_id, $featured_image_size, false, array( "class" => "img-fluid" ) );
            }

        } else {
            $dummy_image_url = houzez_tfp_get_dummy_placeholder_link( $featured_image_size );
            if ( ! empty( $dummy_image_url ) ) {
                return sprintf( '<img class="img-fluid" src="%s" alt="%s">', esc_url( $dummy_image_url ), the_title_attribute( 'echo=0' ) );
            }
        }

        return '';
    }
}

if( !function_exists('houzez_tfp_get_image_placeholder_url')){
    function houzez_tfp_get_image_placeholder_url( $image_size ){

        $placeholder_url = houzez_option( 'houzez_placeholder', false, 'url' );
        if ( ! empty( $placeholder_url ) ) {
            $placeholder_image_id = attachment_url_to_postid( $placeholder_url );
            if ( ! empty( $placeholder_image_id ) ) {
                return wp_get_attachment_image_url( $placeholder_image_id, $image_size, false );
            }
        }

        return houzez_tfp_get_dummy_placeholder_link( $image_size );
    }
}

if( !function_exists('houzez_tfp_get_dummy_placeholder_link')){
    function houzez_tfp_get_dummy_placeholder_link( $image_size ){

        global $_wp_additional_image_sizes;
        $img_width = 0;
        $img_height = 0;
        $img_text = get_bloginfo('name');

        $protocol = 'http';
        $protocol = ( is_ssl() ) ? 'https' : $protocol;

        if ( in_array( $image_size , array( 'thumbnail', 'medium', 'large' ) ) ) {

            $img_width = get_option( $image_size . '_size_w' );
            $img_height = get_option( $image_size . '_size_h' );

        } elseif ( isset( $_wp_additional_image_sizes[ $image_size ] ) ) {

            $img_width = $_wp_additional_image_sizes[ $image_size ]['width'];
            $img_height = $_wp_additional_image_sizes[ $image_size ]['height'];

        }

        if( intval( $img_width ) > 0 && intval( $img_height ) > 0 ) {
            return $protocol.'://placehold.it/' . $img_width . 'x' . $img_height . '&text=' . urlencode( $img_text ) . '';
        }

        return '';
    }
}

if( !function_exists( 'houzez_tfp_image_placeholder' ) ) {
    function houzez_tfp_image_placeholder( $image_size ) {
        echo houzez_tfp_get_image_placeholder( $image_size );
    }
}

if (!function_exists('houzez_tfp_user_role_by_post_id')) {
    /**
     * Get the user role associated with a given post ID.
     *
     * @param int $post_id The post ID.
     * @return string The user role.
     */
    function houzez_tfp_user_role_by_post_id($post_id) {
        if (!is_int($post_id) || $post_id <= 0) {
            return 'houzez_guest';
        }

        $user_id = get_post_field('post_author', $post_id);
        $user_id = intval($user_id);
        return houzez_tfp_user_role_by_user_id($user_id);
    }
}

if (!function_exists('houzez_tfp_user_role_by_user_id')) {
    /**
     * Get the user role associated with a given user ID.
     *
     * @param int $user_id The user ID.
     * @return string The user role.
     */
    function houzez_tfp_user_role_by_user_id($user_id) {
        if (!is_int($user_id) || $user_id <= 0) {
            return 'houzez_guest';
        }

        $user = new WP_User($user_id);
        return $user->roles ? $user->roles[0] : 'houzez_guest';
    }
}

if ( ! function_exists( 'houzez_get_posts' ) ) {
    
    function houzez_get_posts() {
        $keyword   = isset( $_POST['query'] ) ? sanitize_text_field( wp_unslash( $_POST['query'] ) ) : ''; // phpcs:ignore
        $post_type  = isset( $_POST['post_type'] ) ? $_POST['post_type'] : 'post'; // phpcs:ignore
        $data       = array();

        $args = array(
            's'              => $keyword,
            'post_type'      => $post_type,
            'posts_per_page' => - 1,
        );

        $qry = new WP_Query($args);

        if ( ! isset( $qry->posts ) ) {
            return;
        }

        foreach ( $qry->posts as $post ) {
            $data[] = array(
                'id'   => $post->ID,
                'text' => $post->post_title,
            );
        }

        wp_send_json( $data );
    }

    add_action( 'wp_ajax_houzez_get_posts', 'houzez_get_posts' );
    add_action( 'wp_ajax_nopriv_houzez_get_posts', 'houzez_get_posts' );
}

if ( ! function_exists( 'houzez_render_posts_title' ) ) {
    
    function houzez_render_posts_title() {
        $posts_ids  = isset( $_POST['post_id'] ) ? $_POST['post_id'] : array(); // phpcs:ignore
        $post_type  = isset( $_POST['post_type'] ) ? $_POST['post_type'] : 'post'; // phpcs:ignore
        $data       = array();

        $args = array(
            'post_type'      => $post_type,
            'post__in'       => $posts_ids,
            'posts_per_page' => - 1,
            'orderby'        => 'post__in',
        );

        $query = new WP_Query( $args );

        if ( ! isset( $query->posts ) ) {
            return;
        }

        foreach ( $query->posts as $post ) {
            $data[ $post->ID ] = $post->post_title;
        }

        wp_send_json( $data );
    }

    add_action( 'wp_ajax_houzez_render_posts_title', 'houzez_render_posts_title' );
    add_action( 'wp_ajax_nopriv_houzez_render_posts_title', 'houzez_render_posts_title' );
}

if ( ! function_exists( 'houzez_render_taxonomies' ) ) {
    
    function houzez_render_taxonomies() {
        $slugs     = isset( $_POST['post_slug'] ) ? $_POST['post_slug'] : array(); // phpcs:ignore
        $taxonomy      = isset( $_POST['taxonomy'] ) ? $_POST['taxonomy'] : ''; // phpcs:ignore

        $results = array();

        // Check if slugs are empty
        if ( empty( $slugs ) || empty( $taxonomy ) ) {
            wp_send_json( $results );
            return;
        }

        $args = array(
            'slug' => $slugs,
            'taxonomy'   => $taxonomy,
            'hide_empty' => false,
        );

        $terms = get_terms( $args );

        if ( is_array( $terms ) && $terms ) {
            foreach ( $terms as $term ) {
                if ( is_object( $term ) ) {
                    $results[ $term->slug ] = $term->name;
                }
            }
        }

        wp_send_json( $results );
    }

    add_action( 'wp_ajax_houzez_render_taxonomies', 'houzez_render_taxonomies' );
    add_action( 'wp_ajax_nopriv_houzez_render_taxonomies', 'houzez_render_taxonomies' );
}

if ( ! function_exists( 'houzez_get_taxonomies' ) ) {
    
    function houzez_get_taxonomies() {
        $search_string = isset( $_POST['query'] ) ? sanitize_text_field( wp_unslash( $_POST['query'] ) ) : ''; // phpcs:ignore
        $taxonomy      = isset( $_POST['taxonomy'] ) ? $_POST['taxonomy'] : ''; // phpcs:ignore
        $results       = array();

        $args = array(
            'taxonomy'   => $taxonomy,
            'hide_empty' => false,
            'search'     => $search_string,
        );

        $terms = get_terms( $args );

        if ( is_array( $terms ) && $terms ) {
            foreach ( $terms as $term ) {
                if ( is_object( $term ) ) {
                    $results[] = array(
                        'id'   => $term->slug,
                        'text' => $term->name,
                    );
                }
            }
        }

        wp_send_json( $results );
    }

    add_action( 'wp_ajax_houzez_get_taxonomies', 'houzez_get_taxonomies' );
    add_action( 'wp_ajax_nopriv_houzez_get_taxonomies', 'houzez_get_taxonomies' );
}