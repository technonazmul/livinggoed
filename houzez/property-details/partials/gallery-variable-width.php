<?php
global $post;
$size = 'houzez-variable-gallery';
$properties_images = rwmb_meta( 'fave_property_images', 'type=plupload_image&size='.$size, $post->ID );
$gallery_caption = houzez_option('gallery_caption', 0); 
$property_gallery_popup_type = houzez_get_popup_gallery_type(); 
$gallery_token = wp_generate_password(5, false, false);
$output = '';

if( !empty($properties_images) && count($properties_images)) {
?>
<div class="top-gallery-section top-gallery-variable-width-section">
	
	<?php 
    if( $property_gallery_popup_type == "photoswipe" ) { ?>

    	<div class="listing-slider-variable-width houzez-photoswipe houzez-all-slider-wrap" itemscope itemtype="http://schema.org/ImageGallery">
			<?php
			$i = 0;
	        foreach( $properties_images as $prop_image_id => $prop_image_meta ) { $i++;
	  			
				$output .= '<div itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">';
				
				if( is_plugin_active( 'houzez-studio/houzez-studio.php' ) ) : 
					$output .= '<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="all-'.$gallery_token.'" href="'.esc_attr( $prop_image_meta['full_url'] ).'" data-size="'.esc_attr($prop_image_meta['width']).'x'.esc_attr($prop_image_meta['height']).'">';
				else: 
					$output .= '<a href="'.esc_attr( $prop_image_meta['full_url'] ).'" itemprop="contentUrl" data-size="'.esc_attr($prop_image_meta['width']).'x'.esc_attr($prop_image_meta['height']).'">';
				endif;
					$output .= '<img class="img-responsive" data-lazy="'.esc_attr( $prop_image_meta['url'] ).'" src="'.esc_attr( $prop_image_meta['url'] ).'" alt="'.esc_attr($prop_image_meta['alt']).'" title="'.esc_attr($prop_image_meta['title']).'">';
					$output .= '</a>';

					if( !empty($prop_image_meta['caption']) && $gallery_caption != 0 ) {
		               $output .= '<span class="hz-image-caption">'.esc_attr($prop_image_meta['caption']).'</span>';
		            }

				$output .= '</div>';  

				if($i == 5) {
					$i = 0;
				}
	        }
	        echo $output; 
	        ?>
		</div>
		<?php
		if( ! is_plugin_active( 'houzez-studio/houzez-studio.php' ) ) {
            get_template_part( 'property-details/photoswipe'); 
        }?>

    <?php } else { ?>	
		<div class="listing-slider-variable-width houzez-all-slider-wrap">
			<?php
			$i = 0;
	        foreach( $properties_images as $prop_image_id => $prop_image_meta ) { $i++;
	  			
				echo '<div>
						<a rel="gallery-1" href="#" data-slider-no="'.esc_attr($i).'" class="houzez-trigger-popup-slider-js swipebox" data-toggle="modal" data-target="#property-lightbox">
							<img class="img-responsive" data-lazy="'.esc_attr( $prop_image_meta['url'] ).'" src="'.esc_attr( $prop_image_meta['url'] ).'" alt="'.esc_attr($prop_image_meta['alt']).'" title="'.esc_attr($prop_image_meta['title']).'">
						</a>';

						if( !empty($prop_image_meta['caption']) && $gallery_caption != 0 ) {
			               echo '<span class="hz-image-caption">'.esc_attr($prop_image_meta['caption']).'</span>';
			            }

					echo '</div>';

					if($i == 5) {
						$i = 0;
					}
	        }
	        ?>
		</div>
	<?php } ?>
</div><!-- top-gallery-section -->
<?php } ?>