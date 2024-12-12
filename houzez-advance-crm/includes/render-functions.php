<?php
if (!defined('ABSPATH')) exit; // Prevent direct access
require_once plugin_dir_path(__FILE__) . 'functions.php';

// Helper function to safely handle potential null/empty values
function safe_esc_html($value) {
    return (isset($value) && !is_null($value) && $value !== '') ? esc_html($value) : '';
}

// Render the table of leads in the admin page
function houzez_crm_render_table() {
    global $wpdb;
    $leads_table = $wpdb->prefix . 'houzez_crm_leads';
    $enquiry_table = $wpdb->prefix . 'houzez_crm_enquiries';

    // Fetch all leads
    $leads_data = $wpdb->get_results("SELECT * FROM $leads_table");

    ?>
    <div class="container mt-4">
        <h1 class="mb-4">Houzez Advance CRM</h1>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leads_data as $lead) : ?>
                    <tr>
                        <td><?php echo safe_esc_html($lead->lead_id); ?></td>
                        <td><?php echo safe_esc_html($lead->display_name); ?></td>
                        <td><?php echo safe_esc_html($lead->email); ?></td>
                        <td><?php echo safe_esc_html($lead->mobile); ?></td>
                        <td>
                            <a href="<?php echo admin_url('admin.php?page=houzez-crm-lead-details&lead_id=' . esc_attr($lead->lead_id)); ?>" class="btn btn-primary">
                                View Details
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
}

// Render lead details page
function houzez_crm_render_lead_details() {
    if (!isset($_GET['lead_id'])) {
        wp_die('Invalid request.');
    }

    global $wpdb;
    $lead_id = intval($_GET['lead_id']);

    $leads_table = $wpdb->prefix . 'houzez_crm_leads';
    $enquiries_table = $wpdb->prefix . 'houzez_crm_enquiries';

    // Fetch lead details securely
    $lead = $wpdb->get_row($wpdb->prepare("SELECT * FROM $leads_table WHERE lead_id = %d", $lead_id));
    if (!$lead) {
        wp_die('Lead not found.');
    }

    ?>

<ul class="nav nav-pills m-5" id="pills-tab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Leads</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Matched</button>
  </li>
  
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"><?php
            


            // Handle form submission for adding notes/comments
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['comment']) && check_admin_referer('houzez_add_comment', 'houzez_comment_nonce')) {
                $comment = sanitize_text_field($_POST['comment']);
                $wpdb->insert(
                    $enquiries_table,
                    [
                        'lead_id' => $lead_id,
                        'message' => $comment,
                        'time' => current_time('mysql'),
                    ]
                );
        
                // Send email to the lead's email
                wp_mail($lead->email, 'New Comment Added to Your Lead', $comment);
        
                // Redirect to avoid resubmission
                wp_safe_redirect(admin_url('admin.php?page=houzez-crm-lead-details&lead_id=' . $lead_id));
                exit;
            }
        
            ?>
            <div class="container mt-4">
                <h1 class="mb-4">Lead Details: <?php echo safe_esc_html($lead->display_name); ?></h1>
                <table class="table table-bordered">
                    <tr>
                        <th>Email</th>
                        <td><?php echo safe_esc_html($lead->email); ?></td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td><?php echo safe_esc_html($lead->mobile); ?></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td><?php echo safe_esc_html($lead->address); ?></td>
                    </tr>
                </table>
        
                
                <form method="POST">
                    <?php wp_nonce_field('houzez_add_comment', 'houzez_comment_nonce'); ?>
                    <div class="form-group">
                        <label for="comment">Add a Comment or Note</label>
                        <textarea id="comment" name="comment" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Add Comment</button>
                </form>
            </div>
        </div>

        
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
    <?php


    // Fetch associated enquiries for the lead securely
    $enquiries = $wpdb->get_results($wpdb->prepare("SELECT * FROM $enquiries_table WHERE lead_id = %d", $lead_id));
    foreach ($enquiries as $enquiry) :
        $matched_query = crm_matched_listings($enquiry->enquiry_meta);
        
        if ($matched_query->have_posts()) : ?>
            <table class="table table-striped table-bordered"  cellpadding="10" cellspacing="0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Property Type</th>
                        <th>Status</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop through the posts dynamically
                    while ($matched_query->have_posts()) : $matched_query->the_post(); 
                        // Dynamically retrieve custom fields and taxonomies
                        $price = get_post_meta(get_the_ID(), 'fave_property_price', true); // Custom field for price
                        $property_type = wp_get_post_terms(get_the_ID(), 'property_type'); // Taxonomy: property_type
                        $property_status = wp_get_post_terms(get_the_ID(), 'property_status'); // Taxonomy: property_status
                        $location = wp_get_post_terms(get_the_ID(), 'property_city'); // Taxonomy: property_city
                    ?>
                        <tr>
                            <td><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
                            <td><?php echo $price ? number_format($price) : 'N/A'; ?></td>
                            <td>
                                <?php 
                                echo !empty($property_type) ? esc_html($property_type[0]->name) : 'N/A'; 
                                ?>
                            </td>
                            <td>
                                <?php 
                                echo !empty($property_status) ? esc_html($property_status[0]->name) : 'N/A'; 
                                ?>
                            </td>
                            <td>
                                <?php 
                                echo !empty($location) ? esc_html($location[0]->name) : 'N/A'; 
                                ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="pagination">
                <?php
                echo paginate_links(array(
                    'total' => $matched_query->max_num_pages,
                ));
                ?>
            </div>
        <?php else : ?>
            <p>No matching properties found.</p>
        <?php endif; ?>

        <?php
        // Reset post data
        wp_reset_postdata();

            endforeach;
            ?>
  </div>
  
</div>

    
    <?php
}