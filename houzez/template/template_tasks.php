<?php
/**
 * Template Name: Tasks Management
 * Created by Nazmul.
 * Date: 16/12/24
 * Time: 4:22 PM
 */

get_header();
?>

<section class="dashboard-content-wrap">
    <div class="dashboard-content-inner-wrap">
        <div class="dashboard-content-block-wrap">
            <h2 class="text-center mb-4">Task Management</h2>

            <!-- Calendar -->
            <div id="calendar"></div>
        </div><!-- dashboard-content-block-wrap -->
    </div><!-- dashboard-content-inner-wrap -->
</section><!-- dashboard-content-wrap -->

<section class="dashboard-side-wrap">
    <?php get_template_part('template-parts/dashboard/side-wrap'); ?>
</section>

<!-- Task Form Modal -->
<!-- Task Form Modal -->
<div id="task-form-modal" style="display:none;">
<span id="close-modal" style="position: absolute; top: 10px; right: 15px; cursor: pointer; font-size: 20px;">&times;</span>
<button type="button" id="delete-task" style="background-color: #E65B65; color: white;">Delete Task</button>    
<h3 id="modal-title">Calendar event details</h3>
    <form id="task-form">
        <div class="form-row">
            <div class="form-column">
                <label for="task_name">Task Name</label>
                <input type="text" id="task_name" name="task_name" required>

                <label for="user_id" class="form-label">Assign User</label>
                <select id="user_id" name="user_id" class="form-select" required>
                    <option value="">Select User</option>
                    <?php
                    $users = get_users();
                    foreach ($users as $user) {
                        echo '<option value="' . esc_attr($user->ID) . '">' . esc_html($user->display_name) . '</option>';
                    }
                    ?>
                </select>

                <label for="lead_id" class="form-label">Card</label>
                <select name="lead_id" id="lead_id" class="lead_id selectpicker form-control property-lead-js" data-live-search="true" data-size="5" tabindex="null">
                    <option value="">Select Card</option>
                    <?php
                    global $wpdb;
                    $table = $wpdb->prefix . 'houzez_crm_leads';
                    $leads = $wpdb->get_results("SELECT * FROM $table");

                    foreach ($leads as $lead) {
                        echo '<option value="' . esc_attr($lead->lead_id) . '">' . esc_html($lead->display_name) . '</option>';
                    }
                    ?>
                </select>
                <label for="property_id" class="form-label">Object</label>
                <select name="property_id" id="property_id" class="selectpicker form-control property-lead-js" data-live-search="true" data-size="5" tabindex="null">
                    <?php
                                    
                            global $wpdb;
                        
                            // Query to fetch posts where post_type is 'property' and lead_id matches
                            $results_property = $wpdb->get_results(
                                $wpdb->prepare(
                                    "
                                    SELECT * 
                                    FROM {$wpdb->posts}
                                    WHERE post_type = %s
                                    AND post_status = 'publish'
                                    ",
                                    'property',
                                ),
                                
                            );
                        if(!empty($results_property)) {
                            foreach ($results_property as $singleproperty) {
                                $post_title = substr( $singleproperty->post_title, 0, 30 ) . '...';
                                $post_link = get_permalink( $singleproperty->ID );
                                echo '<option value="' . esc_attr($singleproperty->ID) . '">' . esc_html($post_title) . '</option>';
                            }
                        }
                            
                            
                        ?>
                </select>

                <label for="remind_before">Remind before</label>
                <select id="remind_before" name="remind_before">
                    <option value="0">Off</option>
                    <option value="15">15 minutes</option>
                    <option value="30">30 minutes</option>
                    <option value="45">45 minutes</option>
                    <option value="60">1 hour</option>
                    <option value="90">1 hour 30 minutes</option>
                    <option value="120">2 hours</option>
                </select>
                

                
            </div>

            <div class="form-column">
            <label for="task_category" class="form-label">Category</label>
                <select id="task_category" name="task_category">
                    <option value="">Select Category</option>
                    <option value="Bezichtiging">Bezichtiging</option>
                    <option value="Intake">Intake</option>
                    <option value="Contract tekenen">Contract tekenen</option>
                    <option value="Foto's maken">Foto's maken</option>
                    <option value="Bellen">Bellen</option>
                    <option value="Terugbellen">Terugbellen</option>
                    <option value="Appointment at the office">Appointment at the office</option>
                    <option value="Bespreking">Bespreking</option>
                    <option value="Overdracht">Overdracht</option>
                    <option value="Kennismaking">Kennismaking</option>
                    <option value="Waardebepaling">Waardebepaling</option>
                    <option value="Taxatie">Taxatie</option>
                    <option value="Diverse">Diverse</option>
                    <option value="Kapper">Kapper</option>
                    <option value="Lunch">Lunch</option>
                    <option value="Overige">Overige</option>
                    <option value="Overleg">Overleg</option>
                    <option value="Prive">Prive</option>
                    <option value="Reparatie">Reparatie</option>
                </select>
                <label for="start_date">Start Date</label>
                <input type="datetime-local" id="start_date" name="start_date">

                <label for="due_date">Due Date</label>
                <input type="datetime-local" id="due_date" name="due_date">

                <label for="task_duration">Duration</label>
                <select id="task_duration" name="task_duration">
                    <option value="15">15 minutes</option>
                    <option value="30">30 minutes</option>
                    <option value="45">45 minutes</option>
                    <option value="60">1 hour</option>
                    <option value="90">1 hour 30 minutes</option>
                    <option value="120">2 hours</option>
                </select>

                

                

                
            </div>

            <div class="form-column">
                

                <label for="task_description">Description</label>
                <textarea rows="1" cols="1" id="task_description" name="task_description"></textarea>

                <label for="task_status">Status</label>
                <select id="task_status" name="task_status">
                    <option>Status</option>
                    <option value="Bevestigd">Bevestigd</option>
                    <option value="Bellen voor bevestiging">Bellen voor bevestiging</option>
                    <option value="Niet bevestigd">Niet bevestigd</option>
                    <option value="Afgezegd">Afgezegd</option>
                    <option value="Concept">Concept</option>
                    <option value="Accepted">Accepted</option>
                    <option value="Niet verschenen">Niet verschenen</option>
                </select>
                
                

                <label for="task_repeat">Repeat</label>
                <select id="task_repeat" name="task_repeat">
                    <option value="does_not_repeat">Doesn't Repeat</option>
                    <option value="daily">Daily</option>
                    <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                    <option value="annually">Annually</option>
                    <option value="weekdays">Weekdays (Mon-Fri)</option>
                </select>
                <label for="task_address">Address</label>
                <input type="text" id="task_address" name="task_address">
            </div>
        </div>

        <button type="submit" id="save-task">Save Task</button>
    </form>
</div>


<script>
    jQuery(document).ready(function ($) {
        const calendarEl = document.getElementById('calendar');
        const $modal = $('#task-form-modal');
        const $overlay = $('<div id="task-form-modal-overlay"></div>');
        $('body').append($overlay);

        // Function to show the modal
        function showModal() {
            $overlay.show();
            $modal.show();
        }
        

        // Function to hide the modal
        function hideModal() {
            $overlay.hide();
            $modal.hide();
            $('#task-form')[0].reset();
        }

        // Close modal when "X" is clicked
        $('#close-modal').on('click', hideModal);

        // Close modal when clicking outside of it
        $overlay.on('click', hideModal);

        const calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            initialView: 'timeGridDay',
            editable: true,
            selectable: true,
            events: '<?php echo admin_url('admin-ajax.php'); ?>?action=fetch_tasks',
            dateClick: function (info) {
                showModal();

                $('#start_date').val(info.dateStr);
                $('#due_date').val(info.dateStr);

                $('#task-form').off('submit').on('submit', function (e) {
                    e.preventDefault();

                    const formData = {
                        action: 'save_task',
                        task_name: $('#task_name').val(),
                        user_id: $('#user_id').val(),
                        lead_id: $('#lead_id').val(),
                        property_id: $('#property_id').val(),
                        remind_before: $('#remind_before').val(),
                        task_category: $('#task_category').val(),
                        start_date: $('#start_date').val(),
                        due_date: $('#due_date').val(),
                        task_duration: $('#task_duration').val(),
                        task_description: $('#task_description').val(),
                        task_status: $('#task_status').val(),
                        task_repeat: $('#task_repeat').val(),
                        task_address: $('#task_address').val(),
                    };

                    $.ajax({
                        url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        method: 'POST',
                        data: formData,
                        success: function (response) {
                            if (response.success) {
                                alert('Task Added!');
                                calendar.refetchEvents();
                                hideModal();
                            } else {
                                alert('Failed to add task: ' + response.data.message);
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('Error:', error);
                            alert('Failed to add task.');
                        }
                    });
                });
            },
            eventClick: function (info) {
                showModal();

                $('#task_name').val(info.event.title);
                $('#user_id').val(info.event.extendedProps.user_id);
                $('#lead_id').val(info.event.extendedProps.lead_id);
                $('#property_id').val(info.event.extendedProps.property_id);
                $('#remind_before').val(info.event.extendedProps.remind_before);
                $('#task_category').val(info.event.extendedProps.task_category);
                $('#start_date').val(info.event.start.toISOString().slice(0, 16));
                $('#due_date').val(info.event.end ? info.event.end.toISOString().slice(0, 16) : '');
                $('#task_duration').val(info.event.extendedProps.task_duration);
                $('#task_description').val(info.event.extendedProps.description);
                $('#task_status').val(info.event.extendedProps.task_status);
                $('#task_repeat').val(info.event.extendedProps.task_repeat);
                $('#task_address').val(info.event.extendedProps.task_address);

                // select picker refreash
                $('#lead_id').val(info.event.extendedProps.lead_id).selectpicker('refresh');
                $('#property_id').val(info.event.extendedProps.property_id).selectpicker('refresh');

                $('#task-form').off('submit').on('submit', function (e) {
                    e.preventDefault();

                    const formData = {
                        action: 'save_task',
                        task_id: info.event.id,
                        task_name: $('#task_name').val(),
                        user_id: $('#user_id').val(),
                        lead_id: $('#lead_id').val(),
                        property_id: $('#property_id').val(),
                        remind_before: $('#remind_before').val(),
                        task_category: $('#task_category').val(),
                        start_date: $('#start_date').val(),
                        due_date: $('#due_date').val(),
                        task_duration: $('#task_duration').val(),
                        task_description: $('#task_description').val(),
                        task_status: $('#task_status').val(),
                        task_repeat: $('#task_repeat').val(),
                        task_address: $('#task_address').val(),
                    };

                    $.ajax({
                        url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        method: 'POST',
                        data: formData,
                        success: function (response) {
                            if (response.success) {
                                alert('Task Updated!');
                                calendar.refetchEvents();
                                hideModal();
                            } else {
                                alert('Failed to update task: ' + response.data.message);
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('Error:', error);
                            alert('Failed to update task.');
                        }
                    });
                });

                // Handle delete task
            $('#delete-task').on('click', function () {
                if (confirm('Are you sure you want to delete this task?')) {
                    const formData = {
                        action: 'delete_task',
                        task_id: info.event.id,
                    };

                    $.ajax({
                        url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        method: 'POST',
                        data: formData,
                        success: function (response) {
                            if (response.success) {
                                alert('Task Deleted!');
                                calendar.refetchEvents();
                                hideModal();
                            } else {
                                alert('Failed to delete task: ' + response.data.message);
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('Error:', error);
                            alert('Failed to delete task.');
                        }
                    });
                }
            });
            },
            

            
            
            
        });

        calendar.render();
    });
</script>
















<style>
   #task-form-modal {
        display: none;
        position: fixed;
        z-index: 1000;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 90%;
    }

    #task-form-modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
        display: none;
    }

    #close-modal {
        position: absolute;
        top: 10px;
        right: 15px;
        cursor: pointer;
        font-size: 20px;
    }

#task-form-modal h3 {
    margin-bottom: 20px;
    text-align: center;
}

.form-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }

    .form-column {
        display: flex;
        flex-direction: column;
    }

    .form-column label {
        margin-bottom: 4px;
    }

    .form-column input,
    .form-column select,
    .form-column textarea {
        margin-bottom: 12px;
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

#save-task {
    display: block;
    width: 100%;
    padding: 10px;
    background: #0073aa;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    text-align: center;
}

#save-task:hover {
    background: #005f8d;
}

</style>
<?php get_footer(); ?>
