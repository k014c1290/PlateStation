<?php
/*
Plugin Name: PlateStation
Plugin URI: 
Description: PlateStaion App Extension
Version: 1.0.0
Author: Tomoaki Kiriu
Author URI: 
License: GPL2
*/

function add_permission(){
	$role = get_role('author');
	$role->add_cap('upload_files');
}

function add_feature_image($post){
	if(get_post_type($post) === 'dish'){
		$dish_image_id = get_field("dish_image", $post->ID);
		set_post_thumbnail($post, $dish_image_id);
	}
}

add_filter('show_admin_bar', '__return_false');
add_filter('new_to_publish', 'add_feature_image');
add_filter('draft_to_publish', 'add_feature_image');
add_filter('auto-draft_to_publish', 'add_feature_image');
add_filter('pending_to_publish', 'add_feature_image');
if (current_user_can('author') && !current_user_can('upload_files')){
	add_action('admin_init', 'add_permission');
}
?>