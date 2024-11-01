<?php 
/*
 * AJAX function which runs when an option is updated
 */
function toast_mm_update_options(){
	$option = sanitize_text_field($_POST['option']);
	$value = sanitize_text_field($_POST['value']);
	
	if($value == 'off' || $value == 'false'){
		$value = 'off';
	}elseif($value == 'checked' || $value == 'true'){
		$value = 'on';
	}
	
	$toast_mm_options = get_option( 'toast_mm_options' ); 
	$toast_mm_options[$option] = $value;
	update_option('toast_mm_options', $toast_mm_options);
	die();
}
add_action('wp_ajax_toast_mm_update_options', 'toast_mm_update_options');
add_action('wp_ajax_nopriv_toast_mm_update_options', 'toast_mm_update_options');