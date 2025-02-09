<?php 
global $post, $ele_thumbnail_size, $image_size; 
if( houzez_is_fullwidth_2cols_custom_width() ) {
	$image_size = 'houzez-item-image-4';
} else {
	$image_size = 'houzez-item-image-6';
}
?>

<div class="item-listing-wrap hz-item-gallery-js item-listing-wrap-v6 card" data-hz-id="hz-<?php esc_attr_e($post->ID); ?>" <?php houzez_property_gallery($image_size); ?>>
	<div class="item-wrap item-wrap-v6 h-100">
		<div class="d-flex align-items-center h-100">
			<div class="item-header">
				<?php 
				get_template_part('template-parts/listing/partials/item-featured-label'); 
				
				?>
				<div class="custom-price">
				<?php echo houzez_listing_price_v5(); ?>
				</div>
				<?php get_template_part('template-parts/listing/partials/item-labels'); ?>

				<div class="listing-image-wrap">
					<div class="listing-thumb">
						<a class="listing-featured-thumb" <?php houzez_listing_link_target(); ?> href="<?php echo esc_url(get_permalink()); ?>">
						<?php
						$thumbnail_size = !empty($ele_thumbnail_size) ? $ele_thumbnail_size : $image_size;

					    if( has_post_thumbnail( $post->ID ) && get_the_post_thumbnail($post->ID) != '' ) {
					        the_post_thumbnail( $thumbnail_size, array('class' => 'img-fluid') );
					    }else{
					        houzez_image_placeholder( $thumbnail_size );
					    }
						
					    ?>
						</a>
					</div>
				</div>

				<?php get_template_part('template-parts/listing/partials/item-tools'); ?>
				<div class="preview_loader"></div>
			</div><!-- item-header -->	
			<div class="item-body flex-grow-1">
				<?php get_template_part('template-parts/listing/partials/item-title'); ?>
				<hr/>
				<div class="d-flex align-items-center amenities-price-wrap pb-2 pt-2">
					<ul class="item-price-wrap">
						
					</ul>
					<?php get_template_part('template-parts/listing/partials/item-features-v6'); ?>
				</div><!-- d-flex -->
				<hr style="width: 50%;" />
				<div class="bottom-btn">
					<a style="color: white;" href="<?php echo esc_url(get_permalink()); ?>">
					Booking Details
					</a>
				</div>
			</div><!-- item-body -->
		</div><!-- d-flex -->
	</div><!-- item-wrap -->
</div><!-- item-listing-wrap -->

