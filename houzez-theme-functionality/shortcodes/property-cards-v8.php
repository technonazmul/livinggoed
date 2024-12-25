<?php
/*-----------------------------------------------------------------------------------*/
/*	Properties
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_property_card_v8') ) {
	function houzez_property_card_v8($atts, $content = null)
	{
		extract(shortcode_atts(array(
			'property_type' => '',
			'property_status' => '',
			'property_country' => '',
			'property_state' => '',
			'property_city' => '',
			'property_area' => '',
			'property_label' => '',
			'houzez_user_role' => '',
			'featured_prop' => '',
			'posts_limit' => '',
			'sort_by' => '',
			'property_ids' => '',
			'offset' => '',
			'pagination_type' => '',
			'post_status' => '',
			'thumb_size' => '',
			'min_price' => '',
			'max_price' => '',
			'min_beds' => '',
			'max_beds' => '',
			'min_baths' => '',
			'max_baths' => '',
			'properties_by_agents' => '',
			'properties_by_agencies' => ''
		), $atts));

		ob_start();
		global $paged, $ele_thumbnail_size;

		$ele_thumbnail_size = $thumb_size;
		
		if (is_front_page()) {
			$paged = (get_query_var('page')) ? get_query_var('page') : 1;
		}


		$tabs_taxonomy = isset($_GET['tax']) ? $_GET['tax'] : '';
		$tab = isset($_GET['tab']) ? $_GET['tab'] : '';
		if( $tabs_taxonomy == 'property_status' && !empty($tab) ) {
			$property_status = $tab;

		} elseif( $tabs_taxonomy == 'property_type' && !empty($tab) ) {
			$property_type = $tab;

		} elseif( $tabs_taxonomy == 'property_city' && !empty($tab) ) {
			$property_city = $tab;
		}

		//do the query
		$the_query = houzez_data_source::get_wp_query($atts, $paged); //by ref  do the query
		?>
		
		<div id="properties_module_section" class="property-cards-module property-cards-module-v8">
			<div id="module_properties" class="listing-view list-view listing-view-v4">
				<?php
                if ( $the_query->have_posts() ) :
                    while ( $the_query->have_posts() ) : $the_query->the_post();

                        get_template_part('template-parts/listing/item-list', 'v4');

                    endwhile;
                else:
                    get_template_part('template-parts/listing/item', 'none');
                endif;
                wp_reset_postdata();
                ?>

			</div><!-- listing-view -->

			<?php 
			if($pagination_type == 'number') { 
				houzez_pagination( $the_query->max_num_pages, $range = 2 );

			} elseif( $pagination_type == 'loadmore' ) { ?>

				<div id="fave-pagination-loadmore" class="load-more-wrap mb-4 fave-load-more">
                    <a class="btn btn-primary-outlined btn-load-more"  
                    data-paged="2" 
                    data-prop-limit="<?php esc_attr_e($posts_limit); ?>" 
                    data-card="item-list-v4" 
                    data-type="<?php esc_attr_e($property_type); ?>" 
                    data-status="<?php esc_attr_e($property_status); ?>" 
                    data-state="<?php esc_attr_e($property_state); ?>" 
                    data-city="<?php esc_attr_e($property_city); ?>" 
                    data-country="<?php esc_attr_e($property_country); ?>" 
                    data-area="<?php esc_attr_e($property_area); ?>" 
                    data-label="<?php esc_attr_e($property_label); ?>" 
                    data-user-role="<?php esc_attr_e($houzez_user_role); ?>" 
                    data-featured-prop="<?php esc_attr_e($featured_prop); ?>" 
                    data-offset="<?php esc_attr_e($offset); ?>"
                    data-sortby="<?php esc_attr_e($sort_by); ?>"
                    data-property_ids="<?php esc_attr_e($property_ids); ?>"
                    data-min_price="<?php esc_attr_e($min_price); ?>"
                    data-max_price="<?php esc_attr_e($max_price); ?>"
                    data-min_beds="<?php esc_attr_e($min_beds); ?>"
                    data-max_beds="<?php esc_attr_e($max_beds); ?>"
                    data-min_baths="<?php esc_attr_e($min_baths); ?>"
                    data-max_baths="<?php esc_attr_e($max_baths); ?>"
                    data-agents="<?php esc_attr_e($properties_by_agents); ?>"
                    data-agencies="<?php esc_attr_e($properties_by_agencies); ?>"
                    data-post_status="<?php esc_attr_e($post_status); ?>"
                    href="#">
                    	<?php get_template_part('template-parts/loader'); ?>
                    	<?php esc_html_e('Load More', 'houzez'); ?>		
                    </a>               
				</div><!-- load-more-wrap -->
			<?php } ?>
		</div><!-- property-grid-module -->

		<?php
		$result = ob_get_contents();
		ob_end_clean();
		return $result;

	}

	add_shortcode('houzez_property_card_v8', 'houzez_property_card_v8');
}