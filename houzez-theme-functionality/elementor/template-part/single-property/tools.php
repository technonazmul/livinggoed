<?php 
global $post, $loggedin_to_view, $settings;; 
$key = '';
$userID      =   get_current_user_id();
$fav_option = 'houzez_favorites-'.$userID;
$fav_option = get_option( $fav_option );
if( !empty($fav_option) ) {
    $key = array_search($post->ID, $fav_option);
}

$print_class = '';
if( $loggedin_to_view == 1 && !is_user_logged_in() ) {
    $print_class = 'houzez-hidden';
}

$icon = '';
if( $key != false || $key != '' ) {
    $icon = 'text-danger';
}
?>
<ul class="item-tools">

    <?php if( $settings['hide_favorite'] ) { ?>
    <li class="item-tool houzez-favorite">
        <span class="add-favorite-js item-tool-favorite" data-listid="<?php echo intval($post->ID)?>">
            <i class="houzez-icon icon-love-it <?php echo esc_attr($icon); ?>"></i>
        </span><!-- item-tool-favorite -->
    </li><!-- item-tool -->
    <?php } ?>

    <?php if( $settings['hide_social'] ) { ?>
    <li class="item-tool houzez-share">
        <span class="item-tool-share dropdown-toggle" data-toggle="dropdown">
            <i class="houzez-icon icon-share"></i>
        </span><!-- item-tool-favorite -->
        <div class="dropdown-menu dropdown-menu-right item-tool-dropdown-menu">
            <?php get_template_part('property-details/partials/share'); ?>
        </div>
    </li><!-- item-tool -->
    <?php } ?>

    <?php if( $settings['hide_print'] ) { ?>
    <li class="item-tool houzez-print <?php echo esc_attr($print_class); ?>" data-propid="<?php echo intval($post->ID); ?>">
        <span class="item-tool-compare">
            <i class="houzez-icon icon-print-text"></i>
        </span><!-- item-tool-compare -->
    </li><!-- item-tool -->
    <?php } ?>
</ul><!-- item-tools -->