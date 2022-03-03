<?php
/**
 * Plugin Name:     Pantheon Decoupled oAuth
 * Plugin URI:      https://pantheon.io/
 * Description:     Example Application & content to demonstrate sourcing content from a Decoupled WordPress site using WP REST API - OAuth 1.0a Server.
 * Author:          Pantheon
 * Author URI:      https://pantheon.io/
 * Text Domain:     pantheon-decoupled-oauth
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Pantheon_Decoupled_oAuth
 */

/**
 * Create a private post when activating the plugin.
 */
function pantheon_decoupled_oauth_create_post() {
	$image_url = dirname(__FILE__) . '/chocolate-brownies.jpeg';
	$upload_dir = wp_upload_dir();
	$image_data = file_get_contents($image_url);
	$filename = basename($image_url);
	if (wp_mkdir_p($upload_dir['path'])) {
		$file = $upload_dir['path'] . '/' . $filename;
	} else {
		$file = $upload_dir['basedir'] . '/' . $filename;
	}
	file_put_contents($file, $image_data);
	$wp_filetype = wp_check_filetype($filename, null);
	$attachment = array(
		'post_mime_type' => $wp_filetype['type'],
		'post_title' => sanitize_file_name($filename),
		'post_content' => '',
		'post_status' => 'inherit'
	);
	$attach_id = wp_insert_attachment($attachment, $file);
	require_once(ABSPATH . 'wp-admin/includes/image.php');
	$attach_data = wp_generate_attachment_metadata($attach_id, $file);
	wp_update_attachment_metadata($attach_id, $attach_data);

	$example_post = [
		'post_title' => 'Private Example Post',
		'post_content' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
		'post_status' => 'private'
	];
	$post_id = wp_insert_post($example_post);
	set_post_thumbnail($post_id, $attach_id);
}

function patheon_decoupled_oauth_create_consumer() {
	$data = array(
		'name' => 'Example Application',
		'description' => 'An example consumer application that can be used to retrieve data for private posts',
		'meta' => array(
			'callback' => 'https://www.example.com/callback',
		),
	);
	WP_REST_OAuth1_Client::create( $data );
}

/**
 * Create example menu when activating the plugin.
 */
function pantheon_decoupled_oauth_example_menu() {
	$menu = wp_get_nav_menu_object('Example Menu');
	$menu_id = $menu ? $menu->term_id : wp_create_nav_menu('Example Menu');
	wp_update_nav_menu_item($menu_id, 0, [
		'menu-item-title' =>  __('Private Example Post'),
		'menu-item-classes' => 'private_example_post',
		'menu-item-url' => home_url( '/private-example-post/' ),
		'menu-item-status' => 'private'
	]);
    $menu_locations = get_nav_menu_locations();
    $menu_locations['footer'] = $menu_id;
    set_theme_mod( 'nav_menu_locations', $menu_locations );
}

/**
 * Activate the plugin.
 */
function pantheon_decoupled_oauth_activate() {
	activate_plugin( 'rest-api-oauth1/oauth-server.php' );
	pantheon_decoupled_oauth_create_post();
	pantheon_decoupled_oauth_example_menu();
	patheon_decoupled_oauth_create_consumer();
}
register_activation_hook(__FILE__, 'pantheon_decoupled_oauth_activate');
