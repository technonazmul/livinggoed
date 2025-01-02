<?php
global $post, $paged, $listing_founds, $search_qry;

$is_sticky = '';
$sticky_sidebar = houzez_option('sticky_sidebar');
if( $sticky_sidebar['search_sidebar'] != 0 ) { 
    $is_sticky = 'houzez_sticky'; 
}

$listing_view = houzez_option('search_result_posts_layout', 'list-view-v1');
$search_result_layout = houzez_option('search_result_layout');
$search_num_posts = houzez_option('search_num_posts');
$enable_save_search = houzez_option('enable_disable_save_search');

$have_switcher = true;
$card_deck = 'card-deck';

$wrap_class = $item_layout = $view_class = $cols_in_row = '';

if($listing_view == 'list-view-v1') {
    $wrap_class = 'listing-v1';
    $item_layout = 'v1';
    $view_class = 'list-view';

} elseif($listing_view == 'grid-view-v1') {
    $wrap_class = 'listing-v1';
    $item_layout = 'v1';
    $view_class = 'grid-view';

} elseif($listing_view == 'list-view-v2') {
    $wrap_class = 'listing-v2';
    $item_layout = 'v2';
    $view_class = 'list-view';

} elseif($listing_view == 'grid-view-v2') {
    $wrap_class = 'listing-v2';
    $item_layout = 'v2';
    $view_class = 'grid-view';

} elseif($listing_view == 'grid-view-v3') {
    $wrap_class = 'listing-v3';
    $item_layout = 'v3';
    $view_class = 'grid-view';
    $have_switcher = false;

} elseif($listing_view == 'grid-view-v4') {
    $wrap_class = 'listing-v4';
    $item_layout = 'v4';
    $view_class = 'grid-view';
    $have_switcher = false;

} elseif($listing_view == 'list-view-v4') {
    $wrap_class = 'listing-list-v4';
    $item_layout = 'list-v4';
    $view_class = 'list-view listing-view-v4';
    $have_switcher = false;
    $card_deck = '';
    $search_result_layout = 'no-sidebar';

} elseif($listing_view == 'list-view-v5') {
    $wrap_class = 'listing-v5';
    $item_layout = 'v5';
    $view_class = 'list-view';

} elseif($listing_view == 'grid-view-v5') {
    $wrap_class = 'listing-v5';
    $item_layout = 'v5';
    $view_class = 'grid-view';

} elseif($listing_view == 'grid-view-v6') {
    $wrap_class = 'listing-v6';
    $item_layout = 'v6';
    $view_class = 'grid-view';
    $have_switcher = false;

} elseif($listing_view == 'grid-view-v7') {
    $wrap_class = 'listing-v7';
    $item_layout = 'v7';
    $view_class = 'grid-view';
    $have_switcher = false;

} elseif($listing_view == 'list-view-v7') {
    $wrap_class = 'listing-v7';
    $item_layout = 'list-v7';
    $view_class = 'list-view';
    $have_switcher = false;
    $card_deck = '';

} else {
    $wrap_class = 'listing-v1';
    $item_layout = 'v1';
    $view_class = 'grid-view';
}

if($view_class == 'grid-view' && $search_result_layout == 'no-sidebar') {
    $cols_in_row = 'grid-view-3-cols';
}

$page_content_position = houzez_get_listing_data('listing_page_content_area');


if( $search_result_layout == 'no-sidebar' ) {
    $content_classes = 'col-lg-12 col-md-12';
} else if( $search_result_layout == 'left-sidebar' ) {
    $content_classes = 'col-lg-8 col-md-12 bt-content-wrap wrap-order-first';
} else if( $search_result_layout == 'right-sidebar' ) {
    $content_classes = 'col-lg-8 col-md-12 bt-content-wrap';
} else {
    $content_classes = 'col-lg-8 col-md-12 bt-content-wrap';
}

$number_of_prop = $search_num_posts;
if(!$number_of_prop){
    $number_of_prop = 9;
}

if ( is_front_page()  ) {
    $paged = (get_query_var('page')) ? get_query_var('page') : 1;
}

$search_qry = array(
    'post_type' => 'property',
    'posts_per_page' => $number_of_prop,
    'paged' => $paged,
    'post_status' => 'publish'

);

$search_qry = apply_filters( 'houzez20_search_filters', $search_qry );
$search_qry = apply_filters( 'houzez_sold_status_filter', $search_qry );
$search_qry = houzez_prop_sort ( $search_qry );
$search_query = new WP_Query( $search_qry );

$total_records = $search_query->found_posts;

$record_found_text = esc_html__('Result Found', 'houzez');
if( $total_records > 1 ) {
    $record_found_text = esc_html__('Results Found', 'houzez');
}
?>
<section class="listing-wrap <?php echo esc_attr($wrap_class); ?>">
    <div class="container">

        <div class="page-title-wrap">

            <?php get_template_part('template-parts/page/breadcrumb'); ?> 
            <div class="d-flex align-items-center">
                <div class="page-title flex-grow-1">
                    <h1><?php the_title(); ?></h1>
                </div><!-- page-title -->
                <?php 
                if($have_switcher) {
                    get_template_part('template-parts/listing/listing-switch-view'); 
                }?> 
            </div><!-- d-flex -->  

        </div><!-- page-title-wrap -->

        <div class="row">
            <div class="<?php echo esc_attr($content_classes); ?>">

                <?php
                if ( $page_content_position !== '1' ) {
                    if ( have_posts() ) {
                        while ( have_posts() ) {
                            the_post();
                            ?>
                            <article <?php post_class(); ?>>
                                <?php the_content(); ?>
                            </article>
                            <?php
                        }
                    } 
                }?>

                <div class="listing-tools-wrap">
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-grow-1">
                            <strong><?php echo esc_attr($total_records); ?> <?php echo esc_attr($record_found_text); ?></strong>
                        </div>
                        <?php get_template_part('template-parts/listing/listing-sort-by'); ?>   
                        <?php
                        if( $enable_save_search != 0 ) {
                            get_template_part('template-parts/search/save-search-btn');
                        }?> 
                    </div><!-- d-flex -->
                    
                    

                </div><!-- listing-tools-wrap -->

                <div class="listing-view <?php echo esc_attr($view_class).' '.esc_attr($cols_in_row).' '.esc_attr($card_deck); ?>">
                    <?php
                    if ( $search_query->have_posts() ) :
                        while ( $search_query->have_posts() ) : $search_query->the_post();

                            get_template_part('template-parts/listing/item', $item_layout);

                        endwhile;
                    else:
                        
                        echo '<div class="search-no-results-found-wrap">';
                            echo '<div class="search-no-results-found">';
                                esc_html_e('No results found', 'houzez');
                            echo '</div>';
                        echo '</div>';
                        
                    endif;
                    wp_reset_postdata();
                    ?> 
                </div><!-- listing-view -->

                <?php houzez_pagination( $search_query->max_num_pages ); ?>

            </div><!-- bt-content-wrap -->

            <?php if( $search_result_layout != 'no-sidebar' ) { ?>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-md-offset-0 col-sm-offset-3 container-sidebar ">
                <aside id="sidebar" class="sidebar-white" >
                <div id="houzez_advanced_search-2" class="widget widget_houzez_advanced_search"><div class="widget-top"><h3 class="widget-title">Search</h3></div>        <div class="widget-range">
                <div class="widget-body">
                <div class="widget-body-title">Zoeken</div>
                <div class="panel_count_filter"><span class="count_filter"><span>0</span> filters</span><a href="?" class="clear_filter"></a></div>
                <form autocomplete="off" method="get" action="https://curacao3d.getexperthere.online/search-results/"   class="houzez-search-form-js houzez-search-builder-form-js">
                <div class="range-block rang-form-block">
                <div class="row">
                <div class="col-sm-12 col-xs-12 keyword_search">
                <div class="form-group">
                <input type="text" class="houzez_geocomplete form-control" value="" name="keyword" placeholder="Voer een adres, stad, straat, postcode of object-ID in">
                <div id="auto_complete_ajax" class="auto-complete"></div>
                </div>
                </div>
                <div class="col-sm-12 col-xs-12">
                <div class="form-group">
                <input type="text" class="form-control" value="" name="property_id" placeholder="Object ID">
                </div>
                </div>
                <div class="col-sm-12 col-xs-12">
                <div class="form-group">
                </div>
                </div>
                <div class="col-sm-12 col-xs-12">
                <div class="form-group">
                <div class="sel__group_select">
                <div class="sel__label">
                <input type="checkbox" class="radio-style" name="status[]" value="huur" id="sel__radio-huur" onclick="sel__select_check(this);">
                <label for="sel__radio-huur">Huur</label>
                </div>
                </div>
                </div>
                </div>
                <div class="col-sm-12 col-xs-12">
                <div class="form-group">
                <div class="sel__group_select">
                <div class="sel__label">
                <input type="checkbox" class="radio-style" name="status[]" value="koop" id="sel__radio-koop" onclick="sel__select_check(this);">
                <label for="sel__radio-koop">Koop</label>
                </div>
                </div>
                </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                <div class="form-group prices-for-all">
                <select name="min-price" class="sel_picker">
                <option value="">Min. Prijs</option>
                <option value="any">Alles</option><option value="50000">ANG. 50.000</option><option value="100000">ANG. 100.000</option><option value="200000">ANG. 200.000</option><option value="250000">ANG. 250.000</option><option value="300000">ANG. 300.000</option><option value="350000">ANG. 350.000</option><option value="400000">ANG. 400.000</option><option value="450000">ANG. 450.000</option><option value="500000">ANG. 500.000</option><option value="600000">ANG. 600.000</option><option value="700000">ANG. 700.000</option><option value="800000">ANG. 800.000</option><option value="900000">ANG. 900.000</option><option value="1000000">ANG. 1.000.000</option><option value="1500000">ANG. 1.500.000</option><option value="2000000">ANG. 2.000.000</option><option value="2500000">ANG. 2.500.000</option><option value="5000000">ANG. 5.000.000</option>												</select>
                </div>
                <div class="form-group hide prices-only-for-rent">
                <select name="min-price" disabled="disabled" class="sel_picker">
                <option value="">Min. Prijs</option>
                <option value="any">Alles</option><option value="100">ANG. 100</option><option value="600">ANG. 600</option><option value="700">ANG. 700</option><option value="800">ANG. 800</option><option value="900">ANG. 900</option><option value="1000">ANG. 1.000</option><option value="1250">ANG. 1.250</option><option value="1500">ANG. 1.500</option><option value="1750">ANG. 1.750</option><option value="2000">ANG. 2.000</option><option value="2500">ANG. 2.500</option><option value="3000">ANG. 3.000</option><option value="3500">ANG. 3.500</option><option value="4000">ANG. 4.000</option><option value="4500">ANG. 4.500</option><option value="5000">ANG. 5.000</option><option value="10000">ANG. 10.000</option>												</select>
                </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                <div class="form-group prices-for-all">
                <select name="max-price" class="sel_picker">
                <option value="">Max. Prijs</option>
                <option value="any">Alles</option><option value="100000">ANG. 100.000</option><option value="200000">ANG. 200.000</option><option value="250000">ANG. 250.000</option><option value="300000">ANG. 300.000</option><option value="350000">ANG. 350.000</option><option value="400000">ANG. 400.000</option><option value="450000">ANG. 450.000</option><option value="500000">ANG. 500.000</option><option value="600000">ANG. 600.000</option><option value="700000">ANG. 700.000</option><option value="800000">ANG. 800.000</option><option value="900000">ANG. 900.000</option><option value="1000000">ANG. 1.000.000</option><option value="1500000">ANG. 1.500.000</option><option value="2000000">ANG. 2.000.000</option><option value="2500000">ANG. 2.500.000</option><option value="5000000">ANG. 5.000.000</option><option value="10000000">ANG. 10.000.000</option>												</select>
                </div>
                <div class="form-group hide prices-only-for-rent">
                <select name="max-price" disabled="disabled" class="sel_picker">
                <option value="">Max. Prijs</option>
                <option value="any">Alles</option><option value="600">ANG. 600</option><option value="700">ANG. 700</option><option value="800">ANG. 800</option><option value="900">ANG. 900</option><option value="1000">ANG. 1.000</option><option value="1250">ANG. 1.250</option><option value="1500">ANG. 1.500</option><option value="1750">ANG. 1.750</option><option value="2000">ANG. 2.000</option><option value="2500">ANG. 2.500</option><option value="3000">ANG. 3.000</option><option value="3500">ANG. 3.500</option><option value="4000">ANG. 4.000</option><option value="4500">ANG. 4.500</option><option value="5000">ANG. 5.000</option><option value="10000">ANG. 10.000</option><option value="25000">ANG. 25.000</option>												</select>
                </div>
                </div>
                <div class="col-sm-12 col-xs-12">
                <div class="form-group">
                <div class="sel__group_select">
                <div class="sel__label">
                <input type="checkbox" class="radio-style" name="type[]" value="appartement" id="sel__radio-appartement" onclick="sel__select_check(this);">
                <label for="sel__radio-appartement">Appartement</label>
                </div>
                </div>
                </div>
                </div>
                <div class="col-sm-12 col-xs-12">
                <div class="form-group">
                <div class="sel__group_select">
                <div class="sel__label">
                <input type="checkbox" class="radio-style" name="type[]" value="bouwgrond" id="sel__radio-bouwgrond" onclick="sel__select_check(this);">
                <label for="sel__radio-bouwgrond">Bouwgrond</label>
                </div>
                </div>
                </div>
                </div>
                <div class="col-sm-12 col-xs-12">
                <div class="form-group">
                <div class="sel__group_select">
                <div class="sel__label">
                <input type="checkbox" class="radio-style" name="type[]" value="overig-og" id="sel__radio-overig-og" onclick="sel__select_check(this);">
                <label for="sel__radio-overig-og">Overig OG</label>
                </div>
                </div>
                </div>
                </div>
                <div class="col-sm-12 col-xs-12">
                <div class="form-group">
                <div class="sel__group_select">
                <div class="sel__label">
                <input type="checkbox" class="radio-style" name="type[]" value="woonhuis" id="sel__radio-woonhuis" onclick="sel__select_check(this);">
                <label for="sel__radio-woonhuis">Woonhuis</label>
                </div>
                </div>
                </div>
                </div>
                <div class="col-sm-12 col-xs-12">
                <div class="form-group">
                <div class="sel__group_select">
                <div class="sel__label">
                <div class="sel__label_panel">
                <input type="checkbox" class="radio-style" name="type[]" value="bedrijfsobjecten" id="sel__radio-bedrijfsobjecten" onclick="sel__select_check(this);">
                <label for="sel__radio-bedrijfsobjecten">Bedrijfsobjecten</label>
                <span class="icon-arrow-right-blue"></span>
                </div>
                </div>
                <div class="sel__panel_list" style="display:none;">
                <div class="backdrop"></div>
                <span class="icon-close-blue"></span>
                <div class="sel__group_list sel__box_list">
                <!--div class="sel__group_head">'. $term->name .'</div-->
                <ul>
                <li>
                <input type="checkbox" class="radio-style" name="type[]" value="horeca" id="sel__radio-horeca" onclick="sel__select_check(this);">
                <label for="sel__radio-horeca">Horeca</label>
                </li>
                </ul>
                </div>
                </div>
                <div class="sel__selected_options"></div>
                </div>
                </div>
                </div>
                <div class="col-sm-12 col-xs-12">
                <div class="form-group">
                <select name="location" class="sel_picker" data-live-search="true">
                <option value="">Alle plaatsnamen</option>
                <option data-parentstate="" value="grote-berg"> Grote Berg</option>
                <option data-parentstate="" value="jan-thiel"> Jan Thiel</option>
                <option data-parentstate="" value="oranjestad"> Oranjestad</option>
                <option data-parentstate="" value="sabakoe"> Sabakoe</option>
                <option data-parentstate="" value="sint-michiel"> Sint Michiel</option>
                <option data-parentstate="" value="willemstad"> Willemstad</option>                                        
                </select>
                
                </div>
                </div>
                <div class="col-sm-12 col-xs-12">
                <div class="form-group">
                <select name="area" class="sel_picker" data-live-search="true">
                <option value="" style="display: block;">Alle wijken</option><option data-parentcity="" value="abrahamsz" style="display: block;"> Abrahamsz</option><option data-parentcity="" value="atlanta-resort" style="display: block;"> Atlanta Resort</option><option data-parentcity="" value="barber" style="display: block;"> Barber</option><option data-parentcity="" value="bottelier" style="display: block;"> Bottelier</option><option data-parentcity="" value="cas-cora" style="display: block;"> Cas Cora</option><option data-parentcity="" value="cas-coraweg" style="display: block;"> cas coraweg</option><option data-parentcity="" value="cas-grandi" style="display: block;"> Cas Grandi</option><option data-parentcity="" value="curasol" style="display: block;"> Curasol</option><option data-parentcity="" value="damasco-resort-jan-thiel" style="display: block;"> Damasco Resort Jan Thiel</option><option data-parentcity="" value="emmastad" style="display: block;"> Emmastad</option><option data-parentcity="" value="esperanza" style="display: block;"> Esperanza</option><option data-parentcity="" value="groot-davelaar" style="display: block;"> Groot Davelaar</option><option data-parentcity="" value="grote-berg" style="display: block;"> Grote Berg</option><option data-parentcity="" value="hoenderberg" style="display: block;"> Hoenderberg</option><option data-parentcity="" value="jan-sofat" style="display: block;"> Jan Sofat</option><option data-parentcity="" value="jan-thiel" style="display: block;"> Jan Thiel</option><option data-parentcity="" value="julianadorp" style="display: block;"> Julianadorp</option><option data-parentcity="" value="klein-sint-michiel" style="display: block;"> Klein Sint Michiel</option><option data-parentcity="" value="koraal-partier" style="display: block;"> Koraal Partier</option><option data-parentcity="" value="mahaai" style="display: block;"> Mahaai</option><option data-parentcity="" value="mahuma" style="display: block;"> Mahuma</option><option data-parentcity="" value="matancia" style="display: block;"> Matancia</option><option data-parentcity="" value="montana-rey" style="display: block;"> Montana Rey</option><option data-parentcity="" value="noord-aruba" style="display: block;"> Noord Aruba</option><option data-parentcity="" value="papaya-resort" style="display: block;"> Papaya Resort</option><option data-parentcity="" value="parasasa" style="display: block;"> Parasasa</option><option data-parentcity="" value="pietermaai" style="display: block;"> Pietermaai</option><option data-parentcity="" value="piscadera" style="display: block;"> Piscadera</option><option data-parentcity="" value="resort" style="display: block;"> Resort</option><option data-parentcity="" value="salina" style="display: block;"> Salina</option><option data-parentcity="" value="santa-catharina" style="display: block;"> Santa Catharina</option><option data-parentcity="" value="santa-maria" style="display: block;"> Santa Maria</option><option data-parentcity="" value="santa-rosa" style="display: block;"> Santa Rosa</option><option data-parentcity="" value="schelpwijk" style="display: block;"> Schelpwijk</option><option data-parentcity="" value="scherpenheuvel" style="display: block;"> Scherpenheuvel</option><option data-parentcity="" value="semikok" style="display: block;"> Semikok</option><option data-parentcity="" value="suffisant" style="display: block;"> Suffisant</option><option data-parentcity="" value="tera-kora" style="display: block;"> Tera Kora</option><option data-parentcity="" value="toni-kunchi" style="display: block;"> Toni Kunchi</option><option data-parentcity="" value="vredenberg" style="display: block;"> Vredenberg</option><option data-parentcity="" value="wacawa" style="display: block;"> Wacawa</option><option data-parentcity="" value="west-ronde-klip" style="display: block;"> West Ronde Klip</option><option data-parentcity="" value="white-wall" style="display: block;"> White Wall</option><option data-parentcity="" value="zuurzak" style="display: block;"> Zuurzak</option>                                        </select>
                
                </div>
                </div>
                <div class="col-sm-12 col-xs-12">
                <div class="form-group">
                <!--select class="sel_picker" name="label" data-live-search="false">
                <option value="">Alle labels</option>                                        </select-->
                <div>
                <input type="checkbox" name="label[]" value="aangekocht" id="sel__radio-aangekocht" class="radio-style"> 
                <label for="sel__radio-aangekocht">Aangekocht</label>
                </div>
                <div>
                <input type="checkbox" name="label[]" value="beleggingspand" id="sel__radio-beleggingspand" class="radio-style"> 
                <label for="sel__radio-beleggingspand">Beleggingspand</label>
                </div>
                <div>
                <input type="checkbox" name="label[]" value="in-prijs-verlaagd" id="sel__radio-in-prijs-verlaagd" class="radio-style"> 
                <label for="sel__radio-in-prijs-verlaagd">In prijs verlaagd</label>
                </div>
                <div>
                <input type="checkbox" name="label[]" value="nieuwbouw" id="sel__radio-nieuwbouw" class="radio-style"> 
                <label for="sel__radio-nieuwbouw">Nieuwbouw</label>
                </div>
                <div>
                <input type="checkbox" name="label[]" value="open-huis" id="sel__radio-open-huis" class="radio-style"> 
                <label for="sel__radio-open-huis">Open huis</label>
                </div>
                <div>
                <input type="checkbox" name="label[]" value="recreatie" id="sel__radio-recreatie" class="radio-style"> 
                <label for="sel__radio-recreatie">Recreatie</label>
                </div>
                <div>
                <input type="checkbox" name="label[]" value="vakantieverhuur" id="sel__radio-vakantieverhuur" class="radio-style"> 
                <label for="sel__radio-vakantieverhuur">Vakantieverhuur</label>
                </div>
                </div>
                </div>
                <div class="col-sm-12 col-xs-12">
                <div class="form-group">
                <div class="sel__group_select">
                <div class="sel__label">
                <div class="sel__label_panel">
                Slaapkamers													<span class="icon-arrow-right-blue"></span>
                </div>
                </div>
                <div class="sel__panel_list" style="display:none;">
                <div class="backdrop"></div>
                <span class="icon-close-blue"></span>
                <div class="sel__group_list">
                <input name="bedrooms" type="radio" value="" style="display:none;"><ul>						<li>
                <input name="bedrooms" type="radio" value="1" id="bedrooms-1-radiobox" class="radio-style" onclick="sel__select_radio(this);">
                <label for="bedrooms-1-radiobox">1 Slaapkamer</label>
                </li>
                <li>
                <input name="bedrooms" type="radio" value="2" id="bedrooms-2-radiobox" class="radio-style" onclick="sel__select_radio(this);">
                <label for="bedrooms-2-radiobox">2+ Slaapkamers</label>
                </li>
                <li>
                <input name="bedrooms" type="radio" value="3" id="bedrooms-3-radiobox" class="radio-style" onclick="sel__select_radio(this);">
                <label for="bedrooms-3-radiobox">3+ Slaapkamers</label>
                </li>
                <li>
                <input name="bedrooms" type="radio" value="4" id="bedrooms-4-radiobox" class="radio-style" onclick="sel__select_radio(this);">
                <label for="bedrooms-4-radiobox">4+ Slaapkamers</label>
                </li>
                <li>
                <input name="bedrooms" type="radio" value="5" id="bedrooms-5-radiobox" class="radio-style" onclick="sel__select_radio(this);">
                <label for="bedrooms-5-radiobox">5+ Slaapkamers</label>
                </li>
                <li>
                <input name="bedrooms" type="radio" value="6" id="bedrooms-6-radiobox" class="radio-style" onclick="sel__select_radio(this);">
                <label for="bedrooms-6-radiobox">6+ Slaapkamers</label>
                </li>
                <li>
                <input name="bedrooms" type="radio" value="7" id="bedrooms-7-radiobox" class="radio-style" onclick="sel__select_radio(this);">
                <label for="bedrooms-7-radiobox">7+ Slaapkamers</label>
                </li>
                <li>
                <input name="bedrooms" type="radio" value="8" id="bedrooms-8-radiobox" class="radio-style" onclick="sel__select_radio(this);">
                <label for="bedrooms-8-radiobox">8+ Slaapkamers</label>
                </li>
                </ul>												</div>
                </div>
                <div class="sel__selected_options"></div>
                </div>
                </div>
                </div>
                <div class="col-sm-12 col-xs-12">
                <div class="form-group">
                <div class="sel__group_select">
                <div class="sel__label">
                <div class="sel__label_panel">
                Badkamers													<span class="icon-arrow-right-blue"></span>
                </div>
                </div>
                <div class="sel__panel_list" style="display:none;">
                <div class="backdrop"></div>
                <span class="icon-close-blue"></span>
                <div class="sel__group_list">
                <input name="bathrooms" type="radio" value="" style="display:none;"><ul>						<li>
                <input name="bathrooms" type="radio" value="1" id="bathrooms-1-radiobox" class="radio-style" onclick="sel__select_radio(this);">
                <label for="bathrooms-1-radiobox">1 Badkamer</label>
                </li>
                <li>
                <input name="bathrooms" type="radio" value="2" id="bathrooms-2-radiobox" class="radio-style" onclick="sel__select_radio(this);">
                <label for="bathrooms-2-radiobox">2+ Badkamers</label>
                </li>
                <li>
                <input name="bathrooms" type="radio" value="3" id="bathrooms-3-radiobox" class="radio-style" onclick="sel__select_radio(this);">
                <label for="bathrooms-3-radiobox">3+ Badkamers</label>
                </li>
                <li>
                <input name="bathrooms" type="radio" value="4" id="bathrooms-4-radiobox" class="radio-style" onclick="sel__select_radio(this);">
                <label for="bathrooms-4-radiobox">4+ Badkamers</label>
                </li>
                <li>
                <input name="bathrooms" type="radio" value="5" id="bathrooms-5-radiobox" class="radio-style" onclick="sel__select_radio(this);">
                <label for="bathrooms-5-radiobox">5+ Badkamers</label>
                </li>
                <li>
                <input name="bathrooms" type="radio" value="6" id="bathrooms-6-radiobox" class="radio-style" onclick="sel__select_radio(this);">
                <label for="bathrooms-6-radiobox">6+ Badkamers</label>
                </li>
                <li>
                <input name="bathrooms" type="radio" value="7" id="bathrooms-7-radiobox" class="radio-style" onclick="sel__select_radio(this);">
                <label for="bathrooms-7-radiobox">7+ Badkamers</label>
                </li>
                <li>
                <input name="bathrooms" type="radio" value="8" id="bathrooms-8-radiobox" class="radio-style" onclick="sel__select_radio(this);">
                <label for="bathrooms-8-radiobox">8+ Badkamers</label>
                </li>
                </ul>												</div>
                </div>
                <div class="sel__selected_options"></div>
                </div>
                </div>
                </div>
                </div>
                </div>
                <div class="range-block">
                <label>Woonoppervlakte</label>
                <?php 
                // Fetch minimum and maximum area values from GET parameters or set defaults
                    $min_area = isset($_GET['min-area']) && !empty($_GET['min-area']) ? $_GET['min-area'] : 25; // Default minimum area
                    $max_area = isset($_GET['max-area']) && !empty($_GET['max-area']) ? $_GET['max-area'] : 1000; // Default maximum area
                    ?>
                <div class="clearfix range-text">
                    <div class="range-text">
                        <input type="hidden" name="min-area" id="min-area" class="min-area-range-hidden range-input" value="">
                        <input type="hidden" name="max-area" id="max-area" class="max-area-range-hidden range-input" value="">
                        <span class="range-title"><?php echo houzez_option('srh_area_range', 'Area Range:'); ?></span>
                        <?php echo houzez_option('srh_from', 'from'); ?> 
                        <span class="min-area-range"><?php echo esc_html($min_area); ?></span> 
                        <?php echo houzez_option('srh_to', 'to'); ?> 
                        <span class="max-area-range"><?php echo esc_html($max_area); ?></span>
                    </div><!-- range-text -->
                    <div class="area-range-wrap">
                        <div id="area-range" class="area-range"></div><!-- area-range -->
                    </div><!-- area-range-wrap -->
                </div>
                </div>
                <div class="range-block rang-form-block">
                <div class="row">
                <div class="col-sm-12 col-xs-12">
                <div class="form-group">
                <div>
                <input type="checkbox" name="gated_community" value="1" id="sel__radio-gated_community" class="radio-style"> 
                <label for="sel__radio-gated_community">Resort</label>
                </div>
                </div>
                </div>
                <div class="col-sm-12 col-xs-12">
                <div class="form-group">
                <div>
                <input type="checkbox" name="pets_allowed" value="1" id="sel__radio-pets_allowed" class="radio-style"> 
                <label for="sel__radio-pets_allowed">Huisdieren toegestaan</label>
                </div>
                </div>
                </div>
                <div class="col-sm-12 col-xs-12">
                <div class="form-group">
                <div class="sel__group_select">
                <div class="sel__label">
                <div class="sel__label_panel">
                Bijzonderheden											<span class="icon-arrow-right-blue"></span>
                </div>
                </div>
                <div class="sel__panel_list" style="display:none;">
                <div class="backdrop"></div>
                <span class="icon-close-blue"></span>
                <div class="sel__group_list sel__box_list">
                <ul>
                <li>
                <input type="checkbox" class="radio-style" name="specialities[]" value="Furnished" id="sel__radio-Furnished" onclick="sel__select_check(this);">
                <label for="sel__radio-Furnished">Gemeubileerd</label>
                </li>
                <li>
                <input type="checkbox" class="radio-style" name="specialities[]" value="Partly upholstered" id="sel__radio-Partly upholstered" onclick="sel__select_check(this);">
                <label for="sel__radio-Partly upholstered">Gedeeltelijk gestoffeerd</label>
                </li>
                <li>
                <input type="checkbox" class="radio-style" name="specialities[]" value="Monumental building" id="sel__radio-Monumental building" onclick="sel__select_check(this);">
                <label for="sel__radio-Monumental building">Monumentaal pand</label>
                </li>
                <li>
                <input type="checkbox" class="radio-style" name="specialities[]" value="Monument" id="sel__radio-Monument" onclick="sel__select_check(this);">
                <label for="sel__radio-Monument">Monument</label>
                </li>
                <li>
                <input type="checkbox" class="radio-style" name="specialities[]" value="Upholstered" id="sel__radio-Upholstered" onclick="sel__select_check(this);">
                <label for="sel__radio-Upholstered">Gestoffeerd</label>
                </li>
                <li>
                <input type="checkbox" class="radio-style" name="specialities[]" value="Partly rented" id="sel__radio-Partly rented" onclick="sel__select_check(this);">
                <label for="sel__radio-Partly rented">Gedeeltelijk verhuurd</label>
                </li>
                <li>
                <input type="checkbox" class="radio-style" name="specialities[]" value="Double occupancy possible" id="sel__radio-Double occupancy possible" onclick="sel__select_check(this);">
                <label for="sel__radio-Double occupancy possible">Dubbele bewoning mogelijk</label>
                </li>
                <li>
                <input type="checkbox" class="radio-style" name="specialities[]" value="Double occupancy present" id="sel__radio-Double occupancy present" onclick="sel__select_check(this);">
                <label for="sel__radio-Double occupancy present">Dubbele bewoning aanwezig</label>
                </li>
                <li>
                <input type="checkbox" class="radio-style" name="specialities[]" value="Accessible to the elderly" id="sel__radio-Accessible to the elderly" onclick="sel__select_check(this);">
                <label for="sel__radio-Accessible to the elderly">Toegankelijk voor ouderen</label>
                </li>
                <li>
                <input type="checkbox" class="radio-style" name="specialities[]" value="Accessible for the disabled" id="sel__radio-Accessible for the disabled" onclick="sel__select_check(this);">
                <label for="sel__radio-Accessible for the disabled">Toegankelijk voor gehandicapten</label>
                </li>
                <li>
                <input type="checkbox" class="radio-style" name="specialities[]" value="Fixer-upper" id="sel__radio-Fixer-upper" onclick="sel__select_check(this);">
                <label for="sel__radio-Fixer-upper">Kluswoning</label>
                </li>
                <li>
                <input type="checkbox" class="radio-style" name="specialities[]" value="Protected city or village view" id="sel__radio-Protected city or village view" onclick="sel__select_check(this);">
                <label for="sel__radio-Protected city or village view">Beschermd stads- of dorpsgezicht</label>
                </li>
                </ul>
                </div>
                </div>
                <div class="sel__selected_options"></div>
                </div>
                </div>
                </div>
                <div class="col-sm-12 col-xs-12">
                <div class="form-group">
                <div class="sel__group_select">
                <div class="sel__label">
                <div class="sel__label_panel">
                Voorzieningen											<span class="icon-arrow-right-blue"></span>
                </div>
                </div>
                <div class="sel__panel_list" style="display:none;">
                <div class="backdrop"></div>
                <span class="icon-close-blue"></span>
                <div class="sel__group_list sel__box_list">
                <ul>
                <li>
                <input type="checkbox" class="radio-style" name="feature_facilities[]" value="Shutters" id="sel__radio-Shutters" onclick="sel__select_check(this);">
                <label for="sel__radio-Shutters">Rolluiken</label>
                </li>
                <li>
                <input type="checkbox" class="radio-style" name="feature_facilities[]" value="TV cable" id="sel__radio-TV cable" onclick="sel__select_check(this);">
                <label for="sel__radio-TV cable">TV kabel</label>
                </li>
                <li>
                <input type="checkbox" class="radio-style" name="feature_facilities[]" value="Elevator" id="sel__radio-Elevator" onclick="sel__select_check(this);">
                <label for="sel__radio-Elevator">Lift</label>
                </li>
                <li>
                <input type="checkbox" class="radio-style" name="feature_facilities[]" value="Swimming pool" id="sel__radio-Swimming pool" onclick="sel__select_check(this);">
                <label for="sel__radio-Swimming pool">Zwembad</label>
                </li>
                <li>
                <input type="checkbox" class="radio-style" name="feature_facilities[]" value="Mechanical ventilation" id="sel__radio-Mechanical ventilation" onclick="sel__select_check(this);">
                <label for="sel__radio-Mechanical ventilation">Mechanische ventilatie</label>
                </li>
                <li>
                <input type="checkbox" class="radio-style" name="feature_facilities[]" value="Alarm installation" id="sel__radio-Alarm installation" onclick="sel__select_check(this);">
                <label for="sel__radio-Alarm installation">Alarminstallatie</label>
                </li>
                <li>
                <input type="checkbox" class="radio-style" name="feature_facilities[]" value="Outdoor awnings" id="sel__radio-Outdoor awnings" onclick="sel__select_check(this);">
                <label for="sel__radio-Outdoor awnings">Buitenzonwering</label>
                </li>
                <li>
                <input type="checkbox" class="radio-style" name="feature_facilities[]" value="Air conditioning" id="sel__radio-Air conditioning" onclick="sel__select_check(this);">
                <label for="sel__radio-Air conditioning">Airconditioning</label>
                </li>
                <li>
                <input type="checkbox" class="radio-style" name="feature_facilities[]" value="Solar collectors" id="sel__radio-Solar collectors" onclick="sel__select_check(this);">
                <label for="sel__radio-Solar collectors">Zonnecollectoren</label>
                </li>
                <li>
                <input type="checkbox" class="radio-style" name="feature_facilities[]" value="Satellite dish" id="sel__radio-Satellite dish" onclick="sel__select_check(this);">
                <label for="sel__radio-Satellite dish">Satellietschotel</label>
                </li>
                <li>
                <input type="checkbox" class="radio-style" name="feature_facilities[]" value="Jacuzzi" id="sel__radio-Jacuzzi" onclick="sel__select_check(this);">
                <label for="sel__radio-Jacuzzi">Jacuzzi</label>
                </li>
                <li>
                <input type="checkbox" class="radio-style" name="feature_facilities[]" value="Steam room" id="sel__radio-Steam room" onclick="sel__select_check(this);">
                <label for="sel__radio-Steam room">Stoomcabine</label>
                </li>
                <li>
                <input type="checkbox" class="radio-style" name="feature_facilities[]" value="Chimney" id="sel__radio-Chimney" onclick="sel__select_check(this);">
                <label for="sel__radio-Chimney">Rookkanaal</label>
                </li>
                <li>
                <input type="checkbox" class="radio-style" name="feature_facilities[]" value="Sliding door" id="sel__radio-Sliding door" onclick="sel__select_check(this);">
                <label for="sel__radio-Sliding door">Schuifpui</label>
                </li>
                <li>
                <input type="checkbox" class="radio-style" name="feature_facilities[]" value="French balcony" id="sel__radio-French balcony" onclick="sel__select_check(this);">
                <label for="sel__radio-French balcony">Frans balkon</label>
                </li>
                <li>
                <input type="checkbox" class="radio-style" name="feature_facilities[]" value="Windmill" id="sel__radio-Windmill" onclick="sel__select_check(this);">
                <label for="sel__radio-Windmill">Windmolen</label>
                </li>
                <li>
                <input type="checkbox" class="radio-style" name="feature_facilities[]" value="Porthole" id="sel__radio-Porthole" onclick="sel__select_check(this);">
                <label for="sel__radio-Porthole">Dakraam</label>
                </li>
                <li>
                <input type="checkbox" class="radio-style" name="feature_facilities[]" value="Sauna" id="sel__radio-Sauna" onclick="sel__select_check(this);">
                <label for="sel__radio-Sauna">Sauna</label>
                </li>
                <li>
                <input type="checkbox" class="radio-style" name="feature_facilities[]" value="Fiber optic cable" id="sel__radio-Fiber optic cable" onclick="sel__select_check(this);">
                <label for="sel__radio-Fiber optic cable">Glasvezel kabel</label>
                </li>
                </ul>
                </div>
                </div>
                <div class="sel__selected_options"></div>
                </div>
                </div>
                </div>
                </div>
                </div>
                <div class="range-block rang-form-block">
                <div class="row">
                <div class="col-sm-12 col-xs-12">
                <button type="submit" class="btn btn-secondary btn-block"><i class="fa fa-search fa-left"></i>Zoeken</button>
                </div>
                </div>
                </div>
                </form>
                </div>
                </div>
                <script>
                jQuery( document ).ready(function() {
                // toggle panel with .sel__panel_list
                jQuery('.sel__label_panel, .sel__panel_list .backdrop, .sel__panel_list .icon-close-blue, .sel__panel_list .icon-close-blue').click(function(){
                var select = jQuery(this).closest('.sel__group_select');
                select.find('.sel__label_panel').toggleClass('is-open');
                select.find('.sel__panel_list').toggle();
                });
                // select_radio on page load
                jQuery('.sel__group_select input[type="radio"]:checked').each(function(){
                sel__select_radio( this );
                });
                jQuery('.sel__group_select input[type="checkbox"]:checked').each(function(){
                sel__select_check( this );
                });
                // count_filter on page load
                count_filter();
                jQuery('#houzez_advanced_search-2 input[type="text"].form-control, #houzez_advanced_search-2 select.sel_picker, #houzez_advanced_search-2 input.radio-style').change(count_filter);
                // fixed position filter
                if( jQuery(window).width()<980 ){
                var filtr = jQuery('#sidebar>#houzez_advanced_search-2');
                filtr.addClass('fixed');
                filtr.prepend('<span class="icon-close-blue" onClick="toggleFilter();"></span>');
                jQuery('<div class="btn_filter" onClick="toggleFilter();"><span class="wicons2-search-circled"></span> Zoeken</div><div class="backdrop" onClick="toggleFilter();"></div>').insertBefore( filtr );
                }
                });
                function toggleFilter(){
                jQuery('#sidebar>#houzez_advanced_search-2').toggle();
                jQuery('#sidebar>.backdrop').toggle();
                }
                // click on select radiobut
                function sel__select_radio(input){
                var select = jQuery(input).closest('.sel__group_select');
                select.find('.sel__selected_options').html('').append('<div data-name="'+input.name+'" onclick="sel__unselect_radio(this)"><span class="icon-close-blue"></span>'+ jQuery(input).next('label').text() +'</div>');
                if( jQuery(window).width()<980 ){
                jQuery(input).closest('.sel__group_select').find('.backdrop').click();
                }
                }
                // click on select checkbut
                function sel__select_check(input){
                var select = jQuery(input).closest('.sel__group_select');
                if( !jQuery(input).is(':checked') ){
                var selected = select.find('div[data-name="'+input.name+'"][data-value="'+input.value+'"]');
                sel__unselect_check(selected);
                return;
                }
                select.find('.sel__selected_options').append('<div data-name="'+input.name+'" data-value="'+input.value+'" onclick="sel__unselect_check(this)"><span class="icon-close-blue"></span>'+ jQuery(input).next('label').text() +'</div>');
                //if( jQuery(window).width()<980 ){
                //	jQuery(input).closest('.sel__group_select').find('.backdrop').click();
                //}
                }
                // click on unselect radiobut
                function sel__unselect_radio(div_selected){
                var div_selected = jQuery(div_selected);
                jQuery('input[value=""][name="'+ div_selected.attr('data-name') +'"]').click();
                div_selected.remove();
                count_filter();
                }
                // click on unselect checkbut
                function sel__unselect_check(div_selected){
                var div_selected = jQuery(div_selected);
                jQuery('input[value="'+ div_selected.attr('data-value') +'"][name="'+ div_selected.attr('data-name') +'"]').prop('checked', false).change();//.click();
                div_selected.remove();
                count_filter();
                }
                // count_filter
                function count_filter(){
                var count_filter = 
                jQuery('#houzez_advanced_search-2 input[type="radio"]:checked, #houzez_advanced_search-2 input[type="checkbox"]:checked').filter(function(){return this.value!=''}).length 
                + 
                jQuery('#houzez_advanced_search-2 input[type="text"].form-control, #houzez_advanced_search-2 select').filter(function(){return this.value!=''}).length
                ;
                jQuery('#houzez_advanced_search-2 .count_filter>span').html(count_filter);
                }
                </script>
                <script>
                    (function($) {
                        $(document).ready(function() {
                            // Initialize range slider
                            $("#area-range").slider({
                                range: true,
                                min: 0, // Minimum range value for area
                                max: 10000, // Maximum range value for area
                                step: 10, // Step value for the slider
                                values: [0, 10000], // Initial values
                                slide: function(event, ui) {
                                    // Update the visible range values
                                    $(".min-area-range").html(ui.values[0] + " m<sup>2</sup>");
                                    $(".max-area-range").html(ui.values[1] + " m<sup>2</sup>");
                                    // Update the hidden inputs
                                    $("#min-area").val(ui.values[0]);
                                    $("#max-area").val(ui.values[1]);
                                }
                            });

                            // Set initial values for display
                            $(".min-area-range").html($("#area-range").slider("values", 0) + " m<sup>2</sup>");
                            $(".max-area-range").html($("#area-range").slider("values", 1) + " m<sup>2</sup>");
                        });
                    })(jQuery);
                </script>
                </div>
                    <?php
                    // if( is_active_sidebar( 'search-sidebar' ) ) {
                    //     dynamic_sidebar( 'search-sidebar' );
                    // }
                    ?>
                </aside>
            </div><!-- bt-sidebar-wrap -->
            <?php } ?>

        </div><!-- row -->

    </div><!-- container -->
</section><!-- listing-wrap -->



<style>
    .container-sidebar {
        max-width: 30%;
    }
    .sidebar-white .widget:not(.widget-range) {
    padding: 20px !important;
    background-color: #fff;
    }
    .widget-top {
    margin-bottom: 17px;
    }
    #sidebar .widget-title {
    font-size: 16px;
    line-height: 24px;
    margin: 0 0 20px 0;
    font-weight: 700;
    color: #2c9bb6;
    }
    .sidebar-white .widget-range {
    padding-bottom: 0 !important;
    }
    .widget-body {
    font-size: 14px;
    }
    #houzez_advanced_search-2 .widget-body-title {
    font-size: 18px;
    margin: 0 0 10px 0;
    }
    #houzez_advanced_search-2 .panel_count_filter {
    border-bottom: 1px solid #e5e5e5;
    margin: 0 0 15px 0;
    padding: 0 0 5px 0;
    display: inline-block;
    width: 100%;
    }
    #houzez_advanced_search-2 .panel_count_filter .count_filter {
    font-size: 14px;
    line-height: 28px;
    }
    #houzez_advanced_search-2 .panel_count_filter .clear_filter {
    float: right;
    margin: 5px 0 0 0;
    }
    .widget-range .rang-form-block {
    padding: 0 !important;
    }
    .widget-range .range-block + .range-block {
    }
    .widget-range .range-block {
    padding: 12px 0;
    background-color: #fff;
    }
    .ui-slider-horizontal {
    height: 10px;
    background-color: #f9f9f9 !important;
    position: relative;
    border: 1px solid #c5c5c5;
    }
    #sidebar #min-size-text, #sidebar #max-size-text {
    margin: 2px 0 -14px 0 !important;
    }

    #sidebar .widget-range .range-input {
        font-size: 12px;
        line-height: 12px;
        margin: 0;
        font-weight: 400;
    }
    .widget-range .range-input {
        width: 50%;
        color: #909090;
    }
    .sel__group_select {
    position: relative;
    }
    .sel__group_select .sel__label {
    padding: 0 0 10px 0;
    border-bottom: 1px solid #e5e5e5;
    }
    .sel__label_panel {
    border: none;
    background: #fff;
    width: 100%;
    text-align: left;
    font-size: 16px;
    line-height: 30px;
    position: relative;
    margin: 0 0 0 -7px;
    padding: 0 0 2px 8px;
    -webkit-transition: none;
    transition: none;
    cursor: pointer;
    }
    .sel__label_panel .icon-arrow-right-blue {
    content: '';
    position: absolute;
    top: 2px;
    right: -15px;
    height: 30px;
    width: 28px;
    background-image: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA0OCA0OCI+PHBhdGggZGF0YS1uYW1lPSJBcnJvdyBSaWdodCIgZD0iTTMxLjU2IDIyLjkzTDIxIDEyLjM0YTEuNSAxLjUgMCAwIDAtMi4xMiAyLjEyTDI4LjM3IDI0bC05LjU0IDkuNTRBMS41IDEuNSAwIDAgMCAyMSAzNS42NmwxMC41My0xMC41N2ExLjUyIDEuNTIgMCAwIDAgMC0yLjEzeiIgZmlsbD0iIzAwNzFCMyI+PC9wYXRoPjwvc3ZnPg==);
}

.icon-arrow-right-blue {
    height: 100%;
    width: 25px;
    z-index: 7;
    position: absolute;
    right: -14px;
    top: 2px;
}
.sel__panel_list {
    position: absolute;
    left: 100%;
    top: 0;
    z-index: 999;
    margin: -15px 10px 0 10px;
    background: #fff;
    padding: 25px 20px 20px 20px;
    line-height: 2;
    -webkit-box-shadow: 0 0 12px 0 rgba(0, 0, 0, 0.25);
    box-shadow: 0 0 12px 0 rgba(0, 0, 0, 0.25);
    width: auto;
    white-space: nowrap;
}
.sel__group_select .backdrop {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}
.sel__group_select .sel__panel_list .icon-close-blue {
    float: right;
    width: 28px;
    height: 28px;
    margin: -20px -15px 0 0;
    position: relative;
    z-index: 2;
    cursor: pointer;
}
.sel__group_list.sel__box_list {
    padding: 0 0 0 0;
}
.sel__group_list {
    display: inline-block;
    vertical-align: top;
    padding: 0 20px 0 25px;
    position: relative;
}
.sel__group_list ul {
    margin: 0 0 0 0;
}
.sel__group_list ul li {
    list-style: none;
}
input[type="checkbox"].radio-style+label {
    margin: 0 0 5px 32px;
    cursor: pointer;
}
.grid-view .item-listing-wrap {
    z-index: 2;
}
.form-group select.sel_picker {
    width: 100%;
    height: 42px;
    margin: 0;
    background: white;
    border: 1px solid #ccc;
    border-radius: 2px;
    outline: none;
    appearance: none;
    font-size: 14px;
    padding: .31rem .31rem .31em 1rem;
    color: #333;
    line-height: 1.9;
    cursor: pointer;
    transition: border 200ms cubic-bezier(0.23, 1, 0.32, 1);
}
.btn-default {
    color: #333;
    background-color: #fff;
    border-color: #ccc;
}
input[type="checkbox"].radio-style+label:hover:before {
    border-color: #00517F;
    background-image: url(data:image/svg+xml;base64,PHN2ZyBpZD0iTGF5ZXJfMSIgZGF0YS1uYW1lPSJMYXllciAxIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxNiAxNiI+PGRlZnM+PHN0eWxlPi5jbHMtMXtmaWxsOiNjMWRiZTY7ZmlsbC1ydWxlOmV2ZW5vZGQ7fTwvc3R5bGU+PC9kZWZzPjx0aXRsZT5jaGVja2JveC1ob3ZlcjwvdGl0bGU+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNNi41OSw5LjQ1bDUtNUExLDEsMCwxLDEsMTMsNS44OEw3LjMzLDExLjU0YTEsMSwwLDAsMS0uNzkuMjksMSwxLDAsMCwxLS42OS0uMjlMMyw4LjdBMSwxLDAsMCwxLDQuNDMsNy4yOVoiLz48L3N2Zz4=);
}
input[type="checkbox"].radio-style+label:before {
    border: 1px solid #0071B3;
    background-color: #E6F2F7;
    background-repeat: no-repeat;
    background-position: center center;
    border-radius: 2px;
    -webkit-transition: border-color 200ms cubic-bezier(0.23, 1, 0.32, 1), background-image 200ms cubic-bezier(0.23, 1, 0.32, 1);
    transition: border-color 200ms cubic-bezier(0.23, 1, 0.32, 1), background-image 200ms cubic-bezier(0.23, 1, 0.32, 1);
    height: 17px;
    width: 17px;
    display: inline-block;
    margin-right: 7px;
    content: '';
    vertical-align: -3px;
    background-color: #E6F2F7;
    -webkit-box-flex: 0;
    -webkit-flex: 0 0 auto;
    -ms-flex: 0 0 auto;
    flex: 0 0 auto;
    margin-left: -2rem;
}
input[type="checkbox"].radio-style {
    display: none;
}
input[type="checkbox"].radio-style:checked+label:before {
    background-image: url(data:image/svg+xml;base64,PHN2ZyBpZD0iTGF5ZXJfMSIgZGF0YS1uYW1lPSJMYXllciAxIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxNiAxNiI+PGRlZnM+PHN0eWxlPi5jbHMtMXtmaWxsOiMwMDUxN2Y7ZmlsbC1ydWxlOmV2ZW5vZGQ7fTwvc3R5bGU+PC9kZWZzPjx0aXRsZT5jaGVja2JveC1jaGVja2VkLWhvdmVyPC90aXRsZT48cGF0aCBjbGFzcz0iY2xzLTEiIGQ9Ik02LjU5LDkuNDVsNS01QTEsMSwwLDEsMSwxMyw1Ljg4TDcuMzMsMTEuNTRhMSwxLDAsMCwxLS43OS4yOSwxLDEsMCwwLDEtLjY5LS4yOUwzLDguN0ExLDEsMCwwLDEsNC40Myw3LjI5WiIvPjwvc3ZnPg==);
}
.bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
    width: auto !important;
}
</style>

<?php
if ('1' === $page_content_position ) {
    if ( have_posts() ) {
        while ( have_posts() ) {
            the_post();
            ?>
            <section class="content-wrap">
                <?php the_content(); ?>
            </section>
            <?php
        }
    }
}
?>