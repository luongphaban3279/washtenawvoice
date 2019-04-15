<?php
/**
 * NewsPlus Child theme functions
 *
 * Add your custom functions in this file to override parent theme
 * functions. You can also add scripts and CSS in this file.
 *
 */

// Load parent theme stylesheet
add_action( 'wp_enqueue_scripts', 'enqueue_parent_theme_styles', 20 );
function enqueue_parent_theme_styles() {
    wp_enqueue_style( 'newsplus-style', get_template_directory_uri() . '/style.css' );
}

// Load child theme stylesheet after all other CSS files
add_action( 'wp_enqueue_scripts', 'enqueue_child_theme_styles', 100 );
function enqueue_child_theme_styles() {
    wp_enqueue_style( 'newsplus-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'newsplus-style' ),
        wp_get_theme()->get('Version')
    );	
}