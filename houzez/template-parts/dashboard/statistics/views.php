<?php
global $insights_stats, $houzez_local;


$views = $insights_stats['views'];

$lastday = $views['lastday'];
$lasttwo = $views['lasttwo'];
$lasttwo = $lasttwo - $lastday;

$lastweek = $views['lastweek'];
$last2week = $views['last2week'];
$last2week = $last2week - $lastweek;

$lastmonth = $views['lastmonth'];
$last2month = $views['last2month'];
$last2month = $last2month - $lastweek;

?>
<div class="dashboard-content-block dashboard-statistic-block">
	<h3><i class="houzez-icon icon-sign-badge-circle mr-2 primary-text"></i> <?php esc_html_e('Views', 'houzez'); ?></h3>
	<div class="row">
		<div class="col-md-4 col-sm-4 col-4">
			<div class="views-data-wrap">
				<div class="views-data">
					<?php echo number_format_i18n($lastday); ?>
				</div><!-- views-data -->
				
				<?php houzez_views_percentage($lasttwo, $lastday); ?>

				<div class="views-text">
					<?php esc_html_e('Last 24 Hours', 'houzez'); ?>
				</div><!-- views-text -->
			</div><!-- views-data-wrap -->
		</div><!-- col-md-4 col-sm-4 col-4 -->
		<div class="col-md-4 col-sm-4 col-4">
			<div class="views-data-wrap">
				<div class="views-data">
					<?php echo number_format_i18n($views['lastweek']); ?>
				</div><!-- views-data -->
				
				<?php houzez_views_percentage($last2week, $lastweek); ?>

				<div class="views-text">
					<?php esc_html_e('Last 7 Days', 'houzez'); ?>
				</div><!-- views-text -->
			</div><!-- views-data-wrap -->
		</div><!-- col-md-4 col-sm-4 col-4 -->
		<div class="col-md-4 col-sm-4 col-4">
			<div class="views-data-wrap">
				<div class="views-data">
					<?php echo number_format_i18n($views['lastmonth']); ?>
				</div><!-- views-data -->
				
				<?php houzez_views_percentage($last2month, $lastmonth); ?>

				<div class="views-text">
					<?php esc_html_e('Last 30 Days', 'houzez'); ?>
				</div><!-- views-text -->
			</div><!-- views-data-wrap -->
		</div><!-- col-md-4 col-sm-4 col-4 -->
		
	</div>
</div><!-- dashboard-statistic-block -->

<?php 
			if(isset($_GET['listing_id'])) {
				if($_GET['listing_id'] != '') {
					global $wpdb;

				// Table name
				$table_name = $wpdb->prefix . 'houzez_crm_activities';

				// Desired listing_id to search
				$listing_id = $_GET['listing_id']; // Replace with the listing_id you're searching for

				// Prepare the serialized pattern for listing_id
				$search_pattern = '%"listing_id";i:' . $listing_id . ';%';

				// Query to fetch rows with the specified listing_id
				$query = $wpdb->prepare(
					"SELECT * FROM $table_name WHERE meta LIKE %s",
					$search_pattern
				);

				$results = $wpdb->get_results($query);

				// Check and display results
				if (!empty($results)) {
					foreach ($results as $row) {
						$lead_meta = unserialize($row->meta);
						if ($lead_meta) {
							// Format the lead time
							$time_diff = '3 days ago'; // Replace this with actual time difference logic if needed
						
							// Prepare the HTML with lead information
							echo '<div class="activitiy-item-body">
									<ul class="list-unstyled mb-2">
										<li><strong>Name:</strong> ' . htmlspecialchars($lead_meta['name']) . '</li>
										<li><strong>Email:</strong> ' . htmlspecialchars($lead_meta['email']) . '</li>
										<li><strong>Phone:</strong> ' . htmlspecialchars($lead_meta['phone']) . '</li>
									</ul>
								
									<p>' . htmlspecialchars($lead_meta['message']) . '</p>
								</div>';
						}
					}
				} else {
					echo 'No rows found with the specified listing_id.';
				}
				}
				
			}
		?>
