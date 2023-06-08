<?php

// Exit if accessed directly.
if( !defined('ABSPATH') ) exit;

if( !class_exists('acf') ){
    $acf_dir = ABSPATH . 'wp-content/plugins/advanced-custom-fields-pro/';
    include_once($acf_dir . '/acf.php');
}


/**
 * Register UnderFit22 Category
 */
add_filter('block_categories_all', 'mhc22_block_categories', 10, 2);
function mhc22_block_categories($categories, $post)
{

    return array_merge(
        array(
            array(
                'slug' => 'mhc22',
                'title' => __('MotherhoodCommunity', 'mhc22'),
                'icon'  => 'admin-home',
            ),
        ),
        $categories
    );

}


/**
 * ACF Gutenberg Blocks
 */
add_action('acf/init', 'mhc22_register_acf_block_types');
function mhc22_register_acf_block_types()
{
    acf_register_block_type(array(
        'name'              => 'grid3_posts',
        'title'             => __('Grid3 Posts'),
        'description'       => __('This block will show 3 posts in grid.'),
        'render_template'   => 'inc/blocks/grid3-posts.php',
        'category'          => 'mhc22',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'motherhood', 'grid3', 'posts' ),
    ));

    acf_register_block_type(array(
        'name'              => 'grid5_posts',
        'title'             => __('Grid5 Posts'),
        'description'       => __('This block will show 5 posts in grid.'),
        'render_template'   => 'inc/blocks/grid5-posts.php',
        'category'          => 'mhc22',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'motherhood', 'grid5', 'posts' ),
    ));
	
    acf_register_block_type(array(
        'name'              => 'grid5_more_posts',
        'title'             => __('Grid5 More Posts'),
        'description'       => __('This block will show more 5 posts in grid.'),
        'render_template'   => 'inc/blocks/grid5-moreposts.php',
        'category'          => 'mhc22',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'motherhood', 'grid5', 'more', 'posts' ),
    ));

    acf_register_block_type(array(
        'name'              => 'card_posts', 
        'title'             => __('Card Posts'),
        'description'       => __('This block will show 3 posts in grid.'),
        'render_template'   => 'inc/blocks/card-posts.php',
        'category'          => 'mhc22',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'motherhood', 'card', 'posts' ),
    ));

    acf_register_block_type(array(
        'name'              => 'card_more_posts',
        'title'             => __('Card More Posts'),
        'description'       => __('This block will show 3 more posts in grid.'),
        'render_template'   => 'inc/blocks/card-moreposts.php',
        'category'          => 'mhc22',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'motherhood', 'card', 'more', 'posts' ),
    ));

    acf_register_block_type(array(
        'name'              => 'partners_logo',
        'title'             => __('Partners Logo'),
        'description'       => __('This block will show partners logo using splide slider js.'),
        'render_template'   => 'inc/blocks/partners-logo.php',
        'category'          => 'mhc22',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'motherhood', 'partners', 'logo' ),
    ));

    acf_register_block_type(array(
        'name'              => 'signup',
        'title'             => __('Signup'),
        'description'       => __('This block will show Signup form.'),
        'render_template'   => 'inc/blocks/signup.php',
        'category'          => 'mhc22',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'motherhood', 'signup', 'form', 'newsletter' ),
    ));

    acf_register_block_type(array(
        'name'              => 'Sidebar Category',
        'title'             => __('Sidebar Category'),
        'description'       => __('This block will show sidebar.'),
        'render_template'   => 'inc/blocks/sidebar-category.php',
        'category'          => 'mhc22',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'motherhood', 'sidebar', 'category' ),
    ));

    acf_register_block_type(array(
        'name'              => 'Sidebar TOC',
        'title'             => __('Sidebar TOC'),
        'description'       => __('This block will show sidebar.'),
        'render_template'   => 'inc/blocks/sidebar-toc.php',
        'category'          => 'mhc22',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'motherhood', 'sidebar', 'toc' ),
    ));
}


/**
 * ACF Load JSON
 */
add_filter('acf/settings/load_json', 'mhc22_register_acf_json_load_point');
function mhc22_register_acf_json_load_point($paths)
{

    // Change to Theme
    $path = get_stylesheet_directory() . '/acf-json';

    // append path
    $paths[] = $path;

    // return
    return $paths;
}


/**
 * ACF Save JSON
 */
add_filter('acf/settings/save_json', 'mhc22_acf_json_save_point');
function mhc22_acf_json_save_point($path)
{

    // update path
    $path = get_stylesheet_directory() . '/acf-json';

    // return
    return $path;
}


/**
 * General Options
 */
if( function_exists('acf_add_options_page') ){

    acf_add_options_page(array(
        'page_title'     => 'General Options',
        'menu_title'    => 'General Options',
        'menu_slug'     => 'general-options',
        'capability'    => 'edit_posts',
        'redirect'        => false
    ));

}