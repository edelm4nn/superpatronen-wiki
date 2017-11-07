<?php
function cptui_register_my_cpts() {

	/**
	 * Post Type: Wikis.
	 */

	$labels = array(
		"name" => __( "Wikis", "" ),
		"singular_name" => __( "Wiki", "" ),
	);

	$args = array(
		"label" => __( "Wikis", "" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "wiki", "with_front" => false ),
		"query_var" => true,
		"menu_position" => 5,
		"menu_icon" => "dashicons-welcome-learn-more",
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "wiki-entry", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );