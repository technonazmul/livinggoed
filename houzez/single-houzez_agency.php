<?php
get_header();

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) { 

    if( function_exists('fts_single_agency_enabled') && fts_single_agency_enabled() ) {
        do_action('houzez_single_agency');

    } else {   

		$agency_detail_layout = houzez_option('agency-detail-layout', 'v1');

		if( isset( $_GET['single-agency-layout'] ) && $_GET['single-agency-layout'] != "" ) {
			$agency_detail_layout = esc_html($_GET['single-agency-layout']);
		}

		get_template_part( 'template-parts/realtors/agency/single-agency', $agency_detail_layout );
		
	} // end fts_single_agency_enabled
}

get_footer();