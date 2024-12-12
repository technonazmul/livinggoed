<?php
/**
 * User: waqasriaz
 * Date: 5 Sep 2019
 */
$virtual_tour = houzez_get_listing_data('virtual_tour');

if( !empty( $virtual_tour ) ) { ?>
<div class="fw-property-virtual-tour-wrap fw-property-section-wrap" id="property-virtual-tour-wrap">
	<div class="block-wrap">
		<div class="block-title-wrap">
			<h2><?php echo houzez_option('sps_virtual_tour', '360° Virtual Tour'); ?></h2>
		</div><!-- block-title-wrap -->
		<div class="block-content-wrap">
			<div class="block-virtual-video-wrap">
				<?php 
				// Check if the content contains either <iframe> or <embed> tags
				if (strpos($virtual_tour, '<iframe') !== false || strpos($virtual_tour, '<embed') !== false) {
					$virtual_tour = houzez_ensure_iframe_closing_tag($virtual_tour);
				    echo $virtual_tour;
				} else { 
				    $virtual_tour = '<iframe width="853" height="480" src="'.$virtual_tour.'" frameborder="0" allowfullscreen="allowfullscreen"></iframe>';
				    echo $virtual_tour;
				}
				?>
			</div>
		</div><!-- block-content-wrap -->
	</div><!-- block-wrap -->
</div><!-- fw-property-virtual-tour-wrap -->
<?php } ?>