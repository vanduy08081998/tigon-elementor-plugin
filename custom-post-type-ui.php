<?php

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

function cptui_register_my_cpts()
{

	/**
	 * Post Type: Members.
	 */

	$labels = [
		"name" => __("Members", "elementor-tigonhome"),
		"singular_name" => __("Member", "elementor-tigonhome"),
		'all_items' => __('All Members', 'elementor-tigonhome'),
		'add_new' => __('Add New Member', 'elementor-tigonhome'),
		'add_new_item' => __('Add New Member', 'elementor-tigonhome'),
		'not_found' =>  __('Nothing Member found.', 'elementor-tigonhome'),
	];

	$args = [
		"label" => __("Members", "elementor-tigonhome"),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => ["slug" => "members", "with_front" => true],
		"query_var" => true,
		"supports" => ["title", "editor", "thumbnail"],
		"show_in_graphql" => false,
	];

	register_post_type("members", $args);
}

add_action('init', 'cptui_register_my_cpts');

function cptui_register_my_taxes()
{

	/**
	 * Taxonomy: Categories for Members
	 */

	$labels = [
		"name" => __("Role", "elementor-tigonhome"),
		"singular_name" => __("Role", "elementor-tigonhome"),
		'all_items' => __('All Role', 'elementor-tigonhome'),
		'add_new_item' => __('Add New Role', 'elementor-tigonhome'),
		'not_found' =>  __('Nothing Role found.', 'elementor-tigonhome'),
	];

	$args = [
		"label" => __("Role", "elementor-tigonhome"),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => ['slug' => 'member_role', 'with_front' => true,],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "members_role",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy("member_role", ["members"], $args);
}
add_action('init', 'cptui_register_my_taxes');
