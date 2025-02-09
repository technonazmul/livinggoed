<?php
$userID       = get_current_user_id();
$dash_profile_link = houzez_get_template_link_2('template/user_dashboard_profile.php');
$agency_agent_add = add_query_arg( 'agents', 'list', $dash_profile_link );

$agency_id = get_user_meta($userID, 'fave_author_agency_id', true );
$agency_ids_cpt = get_post_meta($agency_id, 'fave_agency_cpt_agent', false );
$action = 'houzez_agency_agent';
$submit_id = 'houzez_agency_agent_register';

$username = $user_email = $first_name = $last_name = $agency_user_agent_id = $agency_user_agent_id = '';
?>
<header class="header-main-wrap dashboard-header-main-wrap">
    <div class="dashboard-header-wrap">
        <div class="d-flex align-items-center">
            <div class="dashboard-header-left flex-grow-1">
                <h1><?php esc_html_e('Add New Agent', 'houzez'); ?></h1>         
            </div><!-- dashboard-header-left -->
            <div class="dashboard-header-right">
                <a class="btn btn-primary" href="<?php echo esc_url($agency_agent_add); ?>"><?php esc_html_e('View All', 'houzez'); ?></a>
            </div><!-- dashboard-header-right -->
        </div><!-- d-flex -->
    </div><!-- dashboard-header-wrap -->
</header><!-- .header-main-wrap -->
<section class="dashboard-content-wrap">
    <div class="dashboard-content-inner-wrap">

        <div class="dashboard-content-block-wrap">
            <div class="dashboard-content-block">
                <div class="add-new-agent-form-wrap">
                    <form method="" action="">
                        <div class="row align-items-center">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="aa_username"><?php esc_html_e('Username','houzez');?></label>
                                    <input type="text" <?php if(!empty($agency_user_id)) { echo 'disabled'; } ?> name="aa_username" id="aa_username"  class="form-control" value="">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="aa_email"><?php esc_html_e('Email','houzez');?></label>
                                    <input type="text" name="aa_email" id="aa_email"  class="form-control" value="">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="aa_firstname"><?php esc_html_e('First Name','houzez');?></label>
                                    <input type="text" name="aa_firstname" id="aa_firstname" class="form-control" value="">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="aa_lastname"><?php esc_html_e('Last Name','houzez');?></label>
                                    <input type="text" name="aa_lastname" id="aa_lastname" class="form-control" value="">
                                </div>
                            </div>

                            <?php 
                            if( houzez_option('user_as_agent') == 'yes' ) { ?>
                                
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="agent_category"><?php esc_html_e('Category','houzez');?></label>
                                        <select name="agent_category" class="selectpicker form-control bs-select-hidden"  data-size="5"data-live-search="true">
                                        <?php
                                        if ( $agency_user_id != "" ) {
                                    
                                            houzez_get_taxonomies_for_edit_listing( $agency_user_agent_id, 'agent_category');

                                        } else {
                                        
                                        echo '<option value="">'.houzez_option('cl_none', 'None').'</option>';                
                                        $agent_category_terms = get_terms (
                                            array(
                                                "agent_category"
                                            ),
                                            array(
                                                'orderby' => 'name',
                                                'order' => 'ASC',
                                                'hide_empty' => false,
                                                'parent' => 0
                                            )
                                        );

                                        houzez_get_taxonomies_with_id_value( 'agent_category', $agent_category_terms, -1);
                                        }
                                        ?>
                                    </select>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="agent_city"><?php esc_html_e('City','houzez');?></label>
                                        <select name="agent_city" class="selectpicker form-control bs-select-hidden"  data-size="5"data-live-search="true">
                                        <?php
                                        if ( $agency_user_id != "" ) {
                                    
                                            houzez_get_taxonomies_for_edit_listing( $agency_user_agent_id, 'agent_city');

                                        } else {
                                        
                                        echo '<option value="">'.houzez_option('cl_none', 'None').'</option>';                
                                        $agent_city_terms = get_terms (
                                            array(
                                                "agent_city"
                                            ),
                                            array(
                                                'orderby' => 'name',
                                                'order' => 'ASC',
                                                'hide_empty' => false,
                                                'parent' => 0
                                            )
                                        );

                                        houzez_get_taxonomies_with_id_value( 'agent_city', $agent_city_terms, -1);
                                        }
                                        ?>
                                    </select>
                                    </div>
                                </div>

                            <?php } ?>

                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="aa_password"><?php esc_html_e('Password','houzez');?></label>
                                    <input type="password" id="aa_password" name="aa_password" value="" class="form-control">
                                </div>
                            </div>

                            <?php if(empty($agency_user_id)) { ?>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group mb-0">
                                    <label class="control control--checkbox mb-0">
                                        <input type="checkbox" id="aa_notification" name="aa_notification" value="">
                                        <?php echo esc_html__('Send the new user an email about their account.', 'houzez');?>
                                        <span class="control__indicator"></span>
                                    </label>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <?php wp_nonce_field( 'houzez_agency_agent_ajax_nonce', 'houzez-security-agency-agent' );   ?>
                        <input type="hidden" name="action" value="<?php echo esc_attr($action); ?>" />
                        <input type="hidden" name="agency_id" value="<?php echo intval($userID); ?>" />
                        <?php if( !empty($agency_ids_cpt)) {
                            foreach( $agency_ids_cpt as $ag_id ): ?>
                            <input type="hidden" name="agency_ids_cpt[]" value="<?php echo esc_attr($ag_id); ?>" />
                        <?php
                            endforeach;
                            } else { ?>
                            <input type="hidden" name="agency_ids_cpt[]" value='' />
                       <?php } ?>
                        <input type="hidden" name="agency_id_cpt" value='<?php echo $agency_id; ?>' />
                        <input type="hidden" name="agency_user_agent_id" value="<?php echo intval($agency_user_agent_id); ?>" />
                        <input type="hidden" name="agency_user_id" value="<?php echo intval($agency_user_id); ?>" />
                        <button id="<?php echo esc_attr($submit_id); ?>" class="btn btn-success">
                            <?php get_template_part('template-parts/loader'); ?>
                            <?php esc_html_e('Save','houzez');?>        
                        </button>
                    </form>
                </div>
            </div><!-- dashboard-content-block -->
        </div><!-- dashboard-content-block-wrap -->
    </div><!-- dashboard-content-inner-wrap -->
</section><!-- dashboard-content-wrap -->