<?php
// Sanitize and validate the 'lead-id' input
$belong_to = isset($_GET['lead-id']) ? intval($_GET['lead-id']) : 0; // Using intval() to convert to integer and ensure it's safe
$notes = Houzez_CRM_Notes::get_notes($belong_to, 'lead');
$user_id = get_current_user_id();
?>
<div class="form-group">
    <textarea class="form-control" id="note" rows="5" placeholder="<?php esc_html_e('Type your note here...', 'houzez'); ?>"></textarea>
    <input type="hidden" id="belong_to" value="<?php echo intval($belong_to); ?>">
    <input type="hidden" id="note_type" value="lead">
    <input type="hidden" id="note_security" value="<?php echo wp_create_nonce('note_add_nonce') ?>">
</div>
<button id="enquiry_note" class="btn btn-primary">
    <?php get_template_part('template-parts/loader'); ?>
    <?php esc_html_e('Add Note', 'houzez'); ?>
</button>

<div id="notes-main-wrap">
<?php
if (!empty($notes)) {
    foreach ($notes as $data) { 
        $datetime = strtotime($data->time);
        
        // Fetch user information
        $user_info = get_userdata($data->user_id);
        $user_name = $user_info ? $user_info->display_name : __('Unknown User', 'houzez');
        ?>

        <div class="private-note-wrap">
            <p class="activity-time">
            <?php printf(__(' %s ago', 'houzez'), human_time_diff($datetime, current_time('timestamp'))); ?>
            </p>

            <p><strong><?php echo esc_html($user_name); ?>:</strong> <?php echo esc_attr($data->note); ?></p>

            <?php 
            if ($user_id == $data->user_id) {
            ?>
            <div class="text-right">
                <a class="delete_note" data-id="<?php echo intval($data->note_id); ?>" href="#" class="ml-3">
                    <i class="houzez-icon icon-remove-circle mr-1"></i> 
                    <strong><?php esc_html_e('Delete', 'houzez'); ?></strong>
                </a>
            </div>
            <?php 
            }
            ?>
        </div>

    <?php
    }
}
?>

</div>