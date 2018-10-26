<?php

function load_custom_scripts(){
	global $wp_styles;

	$template_dir = get_template_directory_uri();
	$stylesheet_dir = get_stylesheet_directory_uri();
	$theme_version = et_get_theme_version();
    $parent_style = 'parent-style';

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	$dependencies_array = array( 'jquery', 'et-jquery-touch-mobile' );

	if ( is_customize_preview() || 'slide' === et_get_option( 'header_style', 'left' ) || 'fullscreen' === et_get_option( 'header_style', 'left' ) ) {
		$dependencies_array[] = 'jquery-effects-core';
	}

    wp_enqueue_style( $parent_style, $template_dir . '/style.css' );
    wp_enqueue_style( 'child-style', $stylesheet_dir . '/style.css', array( $parent_style ), $theme_version );
    wp_enqueue_style( 'bundle-style', $stylesheet_dir . '/dist/css/bundle.css', array(), $theme_version );
    wp_enqueue_style( 'owl-style', $stylesheet_dir . '/css/owl.carousel.css', array(), $theme_version );
    
	wp_enqueue_script( 'owl', $stylesheet_dir . '/js/components/owl.carousel.js', $dependencies_array , $theme_version, true );
	wp_enqueue_script( 'bundle-script', $stylesheet_dir . 'dist/js/bundle.js', $dependencies_array , $theme_version, true );
}
add_action( 'wp_enqueue_scripts', 'load_custom_scripts' );

function DS_Custom_Modules(){
	if(class_exists("ET_Builder_Module")){
		include(get_stylesheet_directory() . "/ds-custom-modules.php");
	}
}

function Prep_DS_Custom_Modules(){
	global $pagenow;

	$is_admin = is_admin();
	$action_hook = $is_admin ? 'wp_loaded' : 'wp';
	$required_admin_pages = array( 'edit.php', 'post.php', 'post-new.php', 'admin.php', 'customize.php', 'edit-tags.php', 'admin-ajax.php', 'export.php' ); // list of admin pages where we need to load builder files
	$specific_filter_pages = array( 'edit.php', 'admin.php', 'edit-tags.php' );
	$is_edit_library_page = 'edit.php' === $pagenow && isset( $_GET['post_type'] ) && 'et_pb_layout' === $_GET['post_type'];
	$is_role_editor_page = 'admin.php' === $pagenow && isset( $_GET['page'] ) && 'et_divi_role_editor' === $_GET['page'];
	$is_import_page = 'admin.php' === $pagenow && isset( $_GET['import'] ) && 'wordpress' === $_GET['import'];
	$is_edit_layout_category_page = 'edit-tags.php' === $pagenow && isset( $_GET['taxonomy'] ) && 'layout_category' === $_GET['taxonomy'];

	if ( ! $is_admin || ( $is_admin && in_array( $pagenow, $required_admin_pages ) && ( ! in_array( $pagenow, $specific_filter_pages ) || $is_edit_library_page || $is_role_editor_page || $is_edit_layout_category_page || $is_import_page ) ) ) {
		add_action($action_hook, 'DS_Custom_Modules', 9789);
	}
}
Prep_DS_Custom_Modules();

function load_custom_core_options() {
    if ( ! function_exists( 'et_load_core_options' ) ) {
        function et_load_core_options() {
            $options = require_once( get_stylesheet_directory() . esc_attr( "/custom_options_divi.php" ) );
        }
    }
}
add_action( 'after_setup_theme', 'load_custom_core_options' );

add_image_size( 'thumb600x600', 600, 600, TRUE );