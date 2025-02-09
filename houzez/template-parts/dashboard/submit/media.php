<?php 
global $property_data, $is_multi_steps, $hide_prop_fields; 

$gallery_image_req = houzez_option('gallery_image_req', 1);

?>
<div id="media" data-gallery-reg="<?php echo esc_attr($gallery_image_req); ?>" class="dashboard-content-block-wrap form-step-gal <?php echo esc_attr($is_multi_steps);?>">
    <h2><?php echo houzez_option('cls_media', 'Property Media'); ?></h2>
    <div class="dashboard-content-block">
        
            <div class="upload-media-gallery">
                <div id="houzez_property_gallery_container" class="row">
 
                    <?php
                    $property_images_count = 0;
                    if(houzez_edit_property()) {
                        $property_images = get_post_meta( $property_data->ID, 'fave_property_images', false );

                        if ( ! empty( $property_images ) ) {
                            $property_images_count = count( array_filter( $property_images ) );
                        }
    

                        $featured_image_id = get_post_thumbnail_id( $property_data->ID );
                        $property_images[] = $featured_image_id;
                        $property_images = array_unique($property_images);

                        if( !empty($property_images[0])) {
                            foreach ($property_images as $prop_image_id) {

                                $is_featured_image = ($featured_image_id == $prop_image_id);
                                $featured_icon = ($is_featured_image) ? 'text-success' : '';

                                $img_available = wp_get_attachment_image($prop_image_id, 'thumbnail');

                                if( !empty($img_available)) {
                                    echo '<div class="col-md-2 col-sm-4 col-6 property-thumb">';
                                    echo wp_get_attachment_image($prop_image_id, 'houzez-item-image-1', false, array('class' => 'img-fluid'));
                                    echo '<div class="upload-gallery-thumb-buttons">';
                                        echo '<button class="icon icon-fav icon-featured" data-property-id="' . intval($property_data->ID) . '" data-attachment-id="' . intval($prop_image_id) . '"><i class="houzez-icon icon-rating-star full-star '.esc_attr($featured_icon).'"></i></button>';

                                        echo '<button class="icon icon-delete" data-property-id="' . intval($property_data->ID) . '" data-attachment-id="' . intval($prop_image_id) . '"><span class="btn-loader houzez-loader-js"></span><i class="houzez-icon icon-remove-circle"></i></button>';
                                    echo '</div>';

                                    echo '<input type="hidden" class="propperty-image-id" name="propperty_image_ids[]" value="' . intval($prop_image_id) . '"/>';

                                    if ($is_featured_image) {
                                        echo '<input type="hidden" class="featured_image_id" name="featured_image_id" value="' . intval($prop_image_id) . '">';
                                    }
                                    
                                    echo '</div>';
                                }
                                
                            }
                        }
                    }
                    ?>
                </div>
            </div>

        <p><?php echo houzez_option('cl_drag_drop_text_image', 'Drag and drop the images to customize the image gallery order.'); ?></p>
        <div class="upload-property-media">
            <div id="houzez_gallery_dragDrop" class="media-drag-drop">
                <div class="upload-icon">
                    <i class="houzez-icon icon-picture-sun"></i>
                </div>
                <div class="upload-image-counter" bis_skin_checked="1"><span class="uploaded"><?php echo esc_attr($property_images_count); ?></span> / <?php echo houzez_option('max_prop_images'); ?></div>
                <div>
                    <?php echo houzez_option('cl_drag_drop_title', 'Drag and drop the gallery images here'); ?><br>
                    
                    <span><?php echo houzez_option('cl_image_featured', 'To mark an image as featured, click the star icon. If no image is marked as featured, the first image will be considered the featured image.'); ?></span>
                </div>
                <a id="select_gallery_images" href="javascript:;" class="btn btn-primary btn-left-icon"><i class="houzez-icon icon-upload-button mr-1"></i> <?php echo houzez_option('cl_image_btn', 'Select and Upload'); ?></a>
            </div>
            <div id="houzez_errors"></div>
            <div class="max-limit-error">The maximum file upload limit has been reached.</div>
        </div>
    </div><!-- dashboard-content-block -->

    <?php if( $hide_prop_fields['video_url'] != 1 ) { ?>
    <h2><?php echo houzez_option('cls_video', 'Video'); ?></h2>
    <div class="dashboard-content-block">
        <?php get_template_part('template-parts/dashboard/submit/form-fields/video'); ?>
    </div><!-- dashboard-content-block -->
    <?php } ?>

</div><!-- dashboard-content-block-wrap -->

