<?php

function pippin_display_notice() {

	/// this displays the notification area if the user has not read it before
	global $user_ID; 
	$notice_args = array('post_type' => 'notices', 'posts_per_page' => 1);
	$notices = get_posts($notice_args);
	if($notices) :
		foreach ($notices as $notice) { ?>
			<?php if(pippin_check_notice_is_read($notice->ID, $user_ID) != true) { ?>
				<div id="notification-area" class="<?php echo strtolower(get_post_meta($notice->ID, '_notice_color', true)); ?> hidden">
					<a class="remove-notice" href="#" id="remove-notice" rel="<?php echo $notice->ID; ?>"><?php _e('X', 'simple-notices'); ?></a>
					<h3><?php echo get_the_title($notice->ID); ?></h3>					
					<?php echo wpautop($notice->post_content); ?>
				</div>
			<?php } ?>
		<?php }
	endif;
}
add_action('wp_footer', 'pippin_display_notice');