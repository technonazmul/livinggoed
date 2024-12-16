<?php
/**
 * Template Name: Tasks Management
 * Created by Nazmul.
 * Date: 16/12/24
 * Time: 4:22 PM
 */

get_header();
?>
<style>
    .elementor-element-7390f8b {
        display: none;
    }
    footer {
        display: none;
    }
    .form-card {
        background: #002B4B;
    color: white;
}
    
</style>
<section class="dashboard-content-wrap">
    <div class="dashboard-content-inner-wrap">
        <div class="dashboard-content-block-wrap">


            <?php
            global $wpdb;
            $table_name = $wpdb->prefix . 'tasks';

            // Check if editing a task
            $edit_task_id = isset($_GET['edit_task']) ? intval($_GET['edit_task']) : null;
            $task_data = null;

            if ($edit_task_id) {
                $task_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $edit_task_id));
                $assigned_users = $task_data ? maybe_unserialize($task_data->user_ids) : [];
            } else {
                $assigned_users = [];
            }

            // Handle form submission
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_task'])) {
                check_admin_referer('save_task_action', 'save_task_nonce'); // Nonce verification

                $task_name = sanitize_text_field($_POST['task_name']);
                $task_description = sanitize_textarea_field($_POST['task_description']);
                $priority = sanitize_text_field($_POST['priority']);
                $lead_id = intval($_POST['lead_id']);
                $user_ids = isset($_POST['user_ids']) ? array_map('intval', $_POST['user_ids']) : [];
                $property_id = intval($_POST['property_id']);
                $start_date = sanitize_text_field($_POST['start_date']);
                $due_date = sanitize_text_field($_POST['due_date']);
                $status = sanitize_text_field($_POST['status']);

                if ($edit_task_id) {
                    // Update task
                    $result = $wpdb->update(
                        $table_name,
                        [
                            'task_name' => $task_name,
                            'task_description' => $task_description,
                            'priority' => $priority,
                            'lead_id' => $lead_id,
                            'user_ids' => maybe_serialize($user_ids),
                            'property_id' => $property_id,
                            'start_date' => $start_date,
                            'due_date' => $due_date,
                            'status' => $status,
                        ],
                        ['id' => $edit_task_id],
                        ['%s', '%s', '%s', '%d', '%s', '%d', '%s', '%s', '%s'],
                        ['%d']
                    );
                    echo $result ? '<div class="alert alert-success">Task updated successfully!</div>' : '<div class="alert alert-danger">Failed to update task.</div>';
                } else {
                    // Create new task
                    $result = $wpdb->insert(
                        $table_name,
                        [
                            'task_name' => $task_name,
                            'task_description' => $task_description,
                            'priority' => $priority,
                            'lead_id' => $lead_id,
                            'user_ids' => maybe_serialize($user_ids),
                            'property_id' => $property_id,
                            'start_date' => $start_date,
                            'due_date' => $due_date,
                            'status' => $status,
                        ],
                        ['%s', '%s', '%s', '%d', '%s', '%d', '%s', '%s', '%s']
                    );
                    echo $result ? '<div class="alert alert-success">Task created successfully!</div>' : '<div class="alert alert-danger">Failed to create task.</div>';
                }

                if ($result) {
                    wp_redirect(get_permalink());
                    exit;
                }
            }
            ?>

            <!-- Task Creation / Editing Form -->
            <div class="card col-6 mb-4 mx-auto">
            
                <div class="card-body form-card">
                <h3><?php echo $edit_task_id ? 'Edit Task' : 'Create a New Task'; ?></h3>
                    <form method="post">
                        <?php wp_nonce_field('save_task_action', 'save_task_nonce'); ?>

                        <div class="mb-3">
                            <label for="task_name" class="form-label">Task Name:</label>
                            <input type="text" id="task_name" name="task_name" class="form-control" required value="<?php echo esc_attr($task_data->task_name ?? ''); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="task_description" class="form-label">Task Description:</label>
                            <textarea id="task_description" name="task_description" class="form-control" rows="3"><?php echo esc_textarea($task_data->task_description ?? ''); ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="priority" class="form-label">Priority:</label>
                            <select id="priority" name="priority" class="form-control">
                                <option value="High" <?php selected($task_data->priority ?? '', 'High'); ?>>High</option>
                                <option value="Medium" <?php selected($task_data->priority ?? '', 'Medium'); ?>>Medium</option>
                                <option value="Low" <?php selected($task_data->priority ?? '', 'Low'); ?>>Low</option>
                            </select>
                        </div>

                        <!-- <div class="mb-3">
                            <label for="lead_id" class="form-label">Lead ID:</label>
                            <input type="number" id="lead_id" name="lead_id" class="form-control" required value="<?php echo esc_attr($task_data->lead_id ?? ''); ?>">
                        </div> -->

                        <div class="mb-3">
                            <label for="user_ids" class="form-label">Assign Users:</label>
                            <select id="user_ids" name="user_ids[]" class="form-control" multiple>
                                <?php
                                $users = get_users();
                                foreach ($users as $user) {
                                    $selected = in_array($user->ID, $assigned_users) ? 'selected' : '';
                                    echo '<option value="' . esc_attr($user->ID) . '" ' . $selected . '>' . esc_html($user->display_name) . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="property_id" class="form-label">Property:</label>
                            <select id="property_id" name="property_id" class="form-control">
                                <option value="">Select Property</option>
                                <?php
                                $properties = get_posts(['post_type' => 'property', 'numberposts' => -1]);
                                foreach ($properties as $property) {
                                    $selected = selected($task_data->property_id ?? '', $property->ID, false);
                                    echo '<option value="' . esc_attr($property->ID) . '" ' . $selected . '>' . esc_html($property->post_title) . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="start_date" class="form-label">Start Date:</label>
                                <input type="datetime-local" id="start_date" name="start_date" class="form-control" value="<?php echo esc_attr($task_data->start_date ?? ''); ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="due_date" class="form-label">Due Date:</label>
                                <input type="datetime-local" id="due_date" name="due_date" class="form-control" value="<?php echo esc_attr($task_data->due_date ?? ''); ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status:</label>
                            <select id="status" name="status" class="form-control">
                                <option value="Pending" <?php selected($task_data->status ?? '', 'Pending'); ?>>Pending</option>
                                <option value="In Progress" <?php selected($task_data->status ?? '', 'In Progress'); ?>>In Progress</option>
                                <option value="Completed" <?php selected($task_data->status ?? '', 'Completed'); ?>>Completed</option>
                            </select>
                        </div>

                        <button type="submit" name="save_task" class="btn btn-primary"><?php echo $edit_task_id ? 'Update Task' : 'Create Task'; ?></button>
                    </form>
                </div>
            </div>

            <!-- Task List -->
            <div class="card">
            <h3>Task List</h3>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Task Name</th>
                                <th>Assigned Users</th>
                                <th>Property</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tasks = $wpdb->get_results("SELECT * FROM $table_name");
                            foreach ($tasks as $task) {
                                $assigned_user_names = [];
                                if (!empty($task->user_ids)) {
                                    $user_ids = maybe_unserialize($task->user_ids);
                                    foreach ($user_ids as $user_id) {
                                        $user = get_user_by('id', $user_id);
                                        if ($user) {
                                            $assigned_user_names[] = $user->user_login;
                                        }
                                    }
                                }
                                $property_name = get_the_title($task->property_id);

                                echo '<tr>';
                                echo '<td>' . esc_html($task->id) . '</td>';
                                echo '<td>' . esc_html($task->task_name) . '</td>';
                                echo '<td>' . esc_html(implode(', ', $assigned_user_names)) . '</td>';
                                echo '<td>' . esc_html($property_name ?: 'N/A') . '</td>';
                                echo '<td>' . esc_html($task->priority) . '</td>';
                                echo '<td>' . esc_html($task->status) . '</td>';
                                echo '<td><a href="?edit_task=' . intval($task->id) . '" class="btn btn-sm btn-warning">Edit</a></td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- dashboard-content-block-wrap -->
    </div><!-- dashboard-content-inner-wrap -->
</section>

<section class="dashboard-side-wrap">
    <?php get_template_part('template-parts/dashboard/side-wrap'); ?>
</section>

<?php get_footer(); ?>
