<div class="form-group">
    <?php
    global $post;

    $args = array(
        'taxonomy'   => 'property_status', // Taxonomy to fetch
        'exclude'    => houzez_option('search_exclude_status', array()),
        'hide_empty' => false, // Include terms even if they have no posts
    );

    $terms = get_terms($args); // Fetch taxonomy terms

    $fave_status = get_post_meta(houzez_postid(), 'fave_status', false);
    $default_status = isset($fave_status) && is_array($fave_status) ? $fave_status : array();

    $status = isset($_GET['status']) ? $_GET['status'] : $default_status;

    if (!is_wp_error($terms) && !empty($terms)) {
        foreach ($terms as $term) {
            $checked = in_array($term->slug, $status) ? 'checked' : '';
            ?>
            <div class="checkbox">
                <label>
                    <input style="width: 25px; height: 16px; color: blue;" type="checkbox" name="status[]" value="<?php echo esc_attr($term->slug); ?>" <?php echo $checked; ?>>
                    <?php echo esc_html($term->name); ?>
                </label>
            </div>
            <?php
        }
    } else {
        echo '<p>' . esc_html__('No statuses found.', 'houzez') . '</p>';
    }
    ?>
</div><!-- form-group -->
