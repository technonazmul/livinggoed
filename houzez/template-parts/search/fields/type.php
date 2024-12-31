<div class="form-group">
    <?php
    global $post;

    $args = array(
        'taxonomy'   => 'property_type', // Taxonomy for property types
        'hide_empty' => false, // Include terms even if they have no posts
    );

    $terms = get_terms($args); // Fetch taxonomy terms

    $fave_types = get_post_meta(houzez_postid(), 'fave_types', false);
    $default_types = isset($fave_types) && is_array($fave_types) ? $fave_types : array();

    $type = isset($_GET['type']) ? $_GET['type'] : $default_types;

    if (!is_wp_error($terms) && !empty($terms)) {
        foreach ($terms as $term) {
            $checked = in_array($term->slug, $type) ? 'checked' : '';
            ?>
            <div class="checkbox">
                <label>
                    <input style="width: 25px; height: 16px; color: blue;" type="checkbox" name="type[]" value="<?php echo esc_attr($term->slug); ?>" <?php echo $checked; ?>>
                    <?php echo esc_html($term->name); ?>
                </label>
            </div>
            <?php
        }
    } else {
        echo '<p>' . esc_html__('No property types found.', 'houzez') . '</p>';
    }
    ?>
</div><!-- form-group -->
