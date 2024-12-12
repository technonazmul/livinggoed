<?php
global $post, $top_area;

if ( houzez_site_width() != '1210px' && $top_area != 'v3' ) {
    $image_size = 'full';
} else {
    $image_size = 'houzez-gallery';
}

$properties_images = rwmb_meta( 'fave_property_images', 'type=plupload_image&size='.$image_size, $post->ID );
$gallery_caption = houzez_option('gallery_caption', 0); 
$property_gallery_popup_type = houzez_get_popup_gallery_type(); 
$gallery_token = wp_generate_password(5, false, false);
if( !empty($properties_images) && count($properties_images) ) {
?>
<div class="top-gallery-section">

    <?php 
    if( $property_gallery_popup_type == "photoswipe" ) { ?>

        <div id="property-gallery-js" class="houzez-photoswipe listing-slider cS-hidden" itemscope itemtype="http://schema.org/ImageGallery">
            <?php
            foreach( $properties_images as $prop_image_id => $prop_image_meta ) {
                $thumb = houzez_get_image_by_id($prop_image_id, 'houzez-item-image-1');

                $image_url = esc_url( $prop_image_meta['full_url'] );
                $image_width = esc_attr( $prop_image_meta['width'] );
                $image_height = esc_attr( $prop_image_meta['height'] );
                $thumbnail_url = esc_url( $prop_image_meta['url'] );
                $image_alt = esc_attr( $prop_image_meta['alt'] );
                $image_title = esc_attr( $prop_image_meta['title'] );
                $gallery_token_safe = esc_attr( $gallery_token );
                ?>
                
                <div data-thumb="<?php echo esc_url( $thumb[0] );?>" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                    <?php
                    if( is_plugin_active( 'houzez-studio/houzez-studio.php' ) ) : ?>
                        <a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="all-<?php echo $gallery_token_safe; ?>" data-size="<?php echo $image_width . 'x' . $image_height; ?>" href="<?php echo $image_url; ?>">
                    <?php else : ?>
                        <a href="<?php echo $image_url; ?>" itemprop="contentUrl" data-size="<?php echo $image_width . 'x' . $image_height; ?>">
                    <?php endif; ?>
                            <img class="img-fluid" src="<?php echo $thumbnail_url; ?>" itemprop="thumbnail" alt="<?php echo $image_alt; ?>" title="<?php echo $image_title; ?>" />
                        </a>
                    <?php
                    if( !empty($prop_image_meta['caption']) && $gallery_caption != 0 ) { ?>
                       <span class="hz-image-caption"><?php esc_attr($prop_image_meta['caption']); ?></span>
                    <?php } ?>
                </div>

            <?php } ?>
        </div>
        <?php 
        if( ! is_plugin_active( 'houzez-studio/houzez-studio.php' ) ) {
            get_template_part( 'property-details/photoswipe'); 
        }?>
    <?php
    } else { ?>

        <div id="property-gallery-js" class="houzez-photoswipe listing-slider cS-hidden">
            <?php
            $i = 0;
            foreach( $properties_images as $prop_image_id => $prop_image_meta ) { $i++;
                $output = '';
                $thumb = houzez_get_image_by_id($prop_image_id, 'houzez-item-image-1');
                
                $output .= '<div data-thumb="'.esc_url( $thumb[0] ).'">';
                        $output .= '<a rel="gallery-1" data-slider-no="'.esc_attr($i).'" href="#" class="houzez-trigger-popup-slider-js swipebox" data-toggle="modal" data-target="#property-lightbox">
                            <img class="img-fluid" src="'.esc_url( $prop_image_meta['url'] ).'" alt="'.esc_attr($prop_image_meta['alt']).'" title="'.esc_attr($prop_image_meta['title']).'">
                        </a>';

                if( !empty($prop_image_meta['caption']) && $gallery_caption != 0 ) {
                   $output .= '<span class="hz-image-caption">'.esc_attr($prop_image_meta['caption']).'</span>';
                }

                $output .= '</div>';

                echo $output;   
            }
            ?>
        </div>

    <?php
    }?>

    
    
</div><!-- top-gallery-section -->
<?php } else if( has_post_thumbnail() ) {
        $output = '';
        $thumb = houzez_get_image_by_id( get_post_thumbnail_id(), 'houzez-gallery') ;
        $output .= '<div data-thumb="'.esc_url( $thumb[0] ).'">';
                    $output .= '<a rel="gallery-1" data-slider-no="1" href="#" class="houzez-trigger-popup-slider-js swipebox" data-toggle="modal" data-target="#property-lightbox">
                        <img class="img-fluid" src="'.esc_url( $thumb[0] ).'" alt="" title="">
                    </a>';


            $output .= '</div>';

            echo $output;   

} else { ?>
<div class="top-gallery-section">
    <?php houzez_image_placeholder( $image_size ); ?>
</div>
<?php } ?>