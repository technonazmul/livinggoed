<?php 
// Fetch minimum and maximum area values from GET parameters or set defaults
$min_area = isset($_GET['min-area']) && !empty($_GET['min-area']) ? $_GET['min-area'] : 25; // Default minimum area
$max_area = isset($_GET['max-area']) && !empty($_GET['max-area']) ? $_GET['max-area'] : 1000; // Default maximum area
?>

<div class="range-text">
    <input type="hidden" name="min-area" id="min-area" class="min-area-range-hidden range-input" value="<?php echo esc_attr($min_area); ?>">
    <input type="hidden" name="max-area" id="max-area" class="max-area-range-hidden range-input" value="<?php echo esc_attr($max_area); ?>">
    <span class="range-title"><?php echo houzez_option('srh_area_range', 'Area Range:'); ?></span>
    <?php echo houzez_option('srh_from', 'from'); ?> 
    <span class="min-area-range"><?php echo esc_html($min_area); ?></span> 
    <?php echo houzez_option('srh_to', 'to'); ?> 
    <span class="max-area-range"><?php echo esc_html($max_area); ?></span>
</div><!-- range-text -->

<div class="area-range-wrap">
    <div id="area-range" class="area-range"></div><!-- area-range -->
</div><!-- area-range-wrap -->

<script>
    (function($) {
        $(document).ready(function() {
            // Initialize range slider
            $("#area-range").slider({
                range: true,
                min: 25, // Minimum range value for area
                max: 1000, // Maximum range value for area
                step: 10, // Step value for the slider
                values: [<?php echo esc_js($min_area); ?>, <?php echo esc_js($max_area); ?>], // Initial values
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