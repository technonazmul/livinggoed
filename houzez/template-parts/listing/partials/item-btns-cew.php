<?php 
global $post, $random_token, $listing_agent_info, $buttonsComposer;

$agent_mobile = $listing_agent_info['agent_mobile'] ?? '';
$agent_whatsapp = $listing_agent_info['agent_whatsapp'] ?? '';
$agent_telegram = $listing_agent_info['agent_telegram'] ?? '';
$agent_lineapp = $listing_agent_info['agent_lineapp'] ?? '';
$agent_email = $listing_agent_info['agent_email'] ?? '';

$i = 0;
if ($buttonsComposer) {
	unset($buttonsComposer['placebo']);
	foreach ($buttonsComposer as $key=>$value) {
		
		if( $key == 'call' && $agent_mobile != '' ) { $i ++;
			?>
		 	<button type="button" class="btn hz-call-popup-js btn-primary-outlined btn-item" data-model-id="call-action-<?php echo esc_attr($post->ID).'-'.$random_token; ?>">
				<i class="houzez-icon icon-phone-actions-ring"></i> <?php esc_html_e('Call', 'houzez'); ?>
			</button>
		 	<?php
		} elseif ( $key == 'email' && $agent_email != '' ) { $i ++;
			?>
			<button type="button" class="btn hz-email-popup-js btn-primary-outlined btn-item" data-model-id="email-popup-<?php echo esc_attr($post->ID).'-'.$random_token; ?>">
				<i class="houzez-icon icon-envelope"></i> <?php esc_html_e('Email', 'houzez'); ?>
			</button>
			<?php
		} elseif ($key == 'whatsapp' && $agent_whatsapp != '' ) { $i ++;
			$agent_whatsapp_call = $listing_agent_info['agent_whatsapp_call'];
			?>
			<a class="btn btn-primary-outlined btn-item" target="_blank" href="https://api.whatsapp.com/send?phone=<?php echo esc_attr( $agent_whatsapp_call ); ?>&text=<?php echo houzez_option('spl_con_interested', "Hello, I am interested in").' ['.get_the_title().'] '.get_permalink(); ?> ">
				<i class="houzez-icon icon-messaging-whatsapp"></i> <span><?php esc_html_e('WhatsApp', 'houzez'); ?></span>
			</a><!-- btn-item -->
			<?php
		} elseif ( $key == 'lineapp' && $agent_lineapp != '' ) { $i ++;
			?>
			<a class="btn btn-primary-outlined btn-item" target="_blank" href="https://line.me/ti/p/~<?php echo esc_attr( $agent_lineapp ); ?>">
				<i class="houzez-icon icon-lineapp-5"></i><span>&nbsp<?php esc_html_e('LINE', 'houzez'); ?></span>
			</a><!-- btn-item -->
			<?php
		} elseif ( $key == 'telegram' && $agent_telegram != '' ) { $i ++;
			?>
			<a class="btn btn-primary-outlined btn-item" target="_blank" href="<?php echo houzezStandardizeTelegramURL($agent_telegram); ?>">
				<i class="houzez-icon icon-telegram-logos-24"></i><span>&nbsp<?php esc_html_e('Telegram', 'houzez'); ?></span>
			</a><!-- btn-item -->
			<?php
		} 

	if($i == 4)
		break;
	}
}