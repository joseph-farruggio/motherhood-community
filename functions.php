<?php

/**
 * Theme setup.
 */
add_action('after_setup_theme', 'mhc22_setup');
function mhc22_setup()
{
	add_theme_support('title-tag');

	register_nav_menus(
		array(
			'primary'   => __('Primary Menu', 'mhc22'),
			'secondary' => __('Secondary Menu', 'mhc22'),
			'footer'    => __('Footer Menu', 'mhc22'),
			'footer2'   => __('Footer2 Menu', 'mhc22'),
		)
	);

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	add_theme_support('custom-logo');
	add_theme_support('post-thumbnails');

	add_theme_support('align-wide');
	add_theme_support('wp-block-styles');

	add_theme_support('editor-styles');
	add_editor_style('css/editor-style.css');

	// Image Sizes
	add_image_size('image-353x0', 353, 0);
	add_image_size('image-384x0', 384, 0);
	add_image_size('image-596x0', 596, 0);
	add_image_size('image-845x0', 845, 0);

	add_image_size('image-0x280', 0, 280);
	add_image_size('image-0x399', 0, 399);

	add_image_size('image-235x155', 235, 155, true);
	add_image_size('image-284x180', 284, 180, true);
	add_image_size('image-320x280', 320, 280, true);
	add_image_size('image-384x256', 384, 256, true);
	add_image_size('image-500x560', 500, 560, true);
	add_image_size('image-595x398', 595, 398, true);
	add_image_size('image-764x480', 764, 480, true);
}

/**
 * Enqueue theme assets.
 */
add_action('wp_enqueue_scripts', 'mhc22_enqueue_scripts');
function mhc22_enqueue_scripts()
{
	$theme = wp_get_theme();

	if (!is_user_logged_in()) {
		wp_dequeue_style('wp-block-library');
		wp_dequeue_style('wp-block-library-theme');
		wp_dequeue_style('wc-blocks-style');
		// wp_dequeue_style('dashicons');
	}

	wp_dequeue_style('megamenu');
	wp_dequeue_style('ez-toc');
	wp_dequeue_style('jquery-migrate');
	wp_dequeue_style('jquery-ui-core');

	wp_enqueue_style('mhc22', mhc22_asset('css/app.css'), array(), $theme->get('Version'));

	// wp_enqueue_style('maxmegamenu', mhc22_asset('css/maxmegamenu.css'), array(), '1.0.0');
	// wp_enqueue_style('formreset', mhc22_asset('css/formreset.min.css'), array(), '1.0.0');
	// wp_enqueue_style('formsmain', mhc22_asset('css/formsmain.min.css'), array(), '1.0.0');
	// wp_enqueue_style('readyclass', mhc22_asset('css/readyclass.min.css'), array(), '1.0.0');
	// wp_enqueue_style('browsers', mhc22_asset('css/browsers.min.css'), array(), '1.0.0');


	if (!is_single(12128)) {
		wp_enqueue_script('splide', mhc22_asset('js/splide.min.js'), array(), '4.0.7', true);
		wp_enqueue_style('splide', mhc22_asset('css/splide.min.css'), array(), $theme->get('Version'));
	}

	wp_enqueue_script('mhc22', mhc22_asset('js/app.js'), array(), $theme->get('Version', true));
	wp_enqueue_script('alpine', mhc22_asset('js/alpine.min.js'), array(), $theme->get('Version', true));
}

function add_media_attribute_to_stylesheets($html, $handle)
{
	// List of handles for the stylesheets you want to modify
	$target_handles = array(
		// 'maxmegamenu',
		'formreset',
		'formsmain',
		"readyclass",
		"splide",
		"addtoany",
		"bcct_style",
		"mailerlite_forms.css",
	);

	// Check if the current handle is in the target list
	if (in_array($handle, $target_handles)) {
		// Add the media and onload attributes to the HTML
		$html = str_replace('<link', '<link media="print" onload="this.media=\'all\'"', $html);
	}

	return $html;
}
add_filter('style_loader_tag', 'add_media_attribute_to_stylesheets', 10, 2);

add_action('gform_enqueue_scripts', 'mhc22_gform_dequeue_script_list');
function mhc22_gform_dequeue_script_list()
{
	global $wp_styles;
	if (isset($wp_styles->registered['gforms_reset_css'])) {
		unset($wp_styles->registered['gforms_reset_css']);
	}
	if (isset($wp_styles->registered['gforms_formsmain_css'])) {
		unset($wp_styles->registered['gforms_formsmain_css']);
	}
	if (isset($wp_styles->registered['gforms_ready_class_css'])) {
		unset($wp_styles->registered['gforms_ready_class_css']);
	}
	if (isset($wp_styles->registered['gforms_browsers_css'])) {
		unset($wp_styles->registered['gforms_browsers_css']);
	}
}

add_filter('script_loader_tag', 'mhc22_defer_parsing_of_js', 10);
function mhc22_defer_parsing_of_js($url)
{
	if (is_user_logged_in())
		return $url;
	if (FALSE === strpos($url, '.js'))
		return $url;
	if (strpos($url, 'jquery.min.js'))
		return $url;
	if (strpos($url, 'wrapper.min.js'))
		return $url;
	return str_replace(' src', ' defer src', $url);
}

/**
 * Get asset path.
 *
 * @param string  $path Path to asset.
 *
 * @return string
 */
function mhc22_asset($path)
{
	if (wp_get_environment_type() === 'production') {
		return get_stylesheet_directory_uri() . '/' . $path;
	}

	return add_query_arg('time', time(), get_stylesheet_directory_uri() . '/' . $path);
}

/**
 * Adds option 'li_class' to 'wp_nav_menu'.
 *
 * @param string  $classes String of classes.
 * @param mixed   $item The curren item.
 * @param WP_Term $args Holds the nav menu arguments.
 *
 * @return array
 */
add_filter('nav_menu_css_class', 'mhc22_nav_menu_add_li_class', 10, 4);
function mhc22_nav_menu_add_li_class($classes, $item, $args, $depth)
{
	if (isset($args->li_class)) {
		$classes[] = $args->li_class;
	}

	if (isset($args->{"li_class_$depth"})) {
		$classes[] = $args->{"li_class_$depth"};
	}

	return $classes;
}

/**
 * Adds option 'submenu_class' to 'wp_nav_menu'.
 *
 * @param string  $classes String of classes.
 * @param mixed   $item The curren item.
 * @param WP_Term $args Holds the nav menu arguments.
 *
 * @return array
 */
add_filter('nav_menu_submenu_css_class', 'mhc22_nav_menu_add_submenu_class', 10, 3);
function mhc22_nav_menu_add_submenu_class($classes, $args, $depth)
{
	if (isset($args->submenu_class)) {
		$classes[] = $args->submenu_class;
	}

	if (isset($args->{"submenu_class_$depth"})) {
		$classes[] = $args->{"submenu_class_$depth"};
	}

	return $classes;
}

// 
add_action('init', 'mhc22_register_post_types');
function mhc22_register_post_types()
{
	register_post_type(
		'podcasts',
		array(
			'labels'      => array(
				'name'          => __('Podcast'),
				'singular_name' => __('Podcast')
			),
			'public'      => true,
			'has_archive' => true,
			'supports'    => array('title', 'editor', 'author', 'excerpt', 'comments', 'thumbnail'),
			'taxonomies'  => array('category'),
			'rewrite'     => array('with_front' => true, 'slug' => 'podcasts'),
		)
	);

	register_post_type(
		'product',
		array(
			'labels'              => array(
				'name'               => __('Products', 'mhc22'),
				'singular_name'      => __('Product', 'mhc22'),
				'menu_name'          => __('Products', 'mhc22'),
				'name_admin_bar'     => __('Products', 'mhc22'),
				'all_items'          => __('All Products', 'mhc22'),
				'add_new'            => _x('Add New', 'parts', 'mhc22'),
				'add_new_item'       => __('Add New Product', 'mhc22'),
				'edit_item'          => __('Edit Product', 'mhc22'),
				'new_item'           => __('New Product', 'mhc22'),
				'view_item'          => __('View Product', 'mhc22'),
				'search_items'       => __('Search Product', 'mhc22'),
				'not_found'          => __('No products found.', 'mhc22'),
				'not_found_in_trash' => __('No products found in Trash.', 'mhc22'),
				'parent_item_colon'  => __('Parent Product:', 'mhc22'),
			),
			'publicly_queryable'  => true,
			'exclude_from_search' => true,
			'has_archive'         => false,
			'public'              => true,
			'supports'            => array('title', 'thumbnail', 'editor'),
			'menu_icon'           => 'dashicons-admin-generic',
		)
	);

	register_taxonomy(
		'product-category',
		'product',
		array(
			'label'        => __('Product Categories'),
			'rewrite'      => array('slug' => 'product-category'),
			'hierarchical' => true,
		)
	);
}

// 
add_action('widgets_init', 'mhc22_theme_widgets_init');
function mhc22_theme_widgets_init()
{
	register_sidebar(
		array(
			'name'          => __('Page Sidebar', 'mhc22'),
			'id'            => 'page-sidebar',
			'description'   => __('Widgets in this area will be shown on all posts and pages.', 'mhc22'),
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget'  => '<span class="sidebar-arrow icon-cheveron-down"></span></li>',
		)
	);
	register_sidebar(
		array(
			'name'          => __('Post Sidebar', 'mhc22'),
			'id'            => 'post-sidebar',
			'description'   => __('Widgets in this area will be shown on single posts', 'mhc22'),
			'before_widget' => '<div id="%1$s">',
			'after_widget'  => '</div>',
		)
	);
	register_sidebar(
		array(
			'name'          => __('Post Sidebar 2', 'mhc22'),
			'id'            => 'post-sidebar-2',
			'description'   => __('Widgets in this area will be shown on single products and podcast.', 'mhc22'),
			'before_widget' => '<div id="%1$s">',
			'after_widget'  => '</div>',
		)
	);
}

// 
require_once get_stylesheet_directory() . '/inc/acf-functions.php';
require_once get_stylesheet_directory() . '/inc/custom-functions.php';
require_once get_stylesheet_directory() . '/inc/bt-breadcrumb.php';

// 
function get_category_tags($args)
{
	global $wpdb;
	$table1 = $wpdb->prefix . 'posts';
	$table2 = $wpdb->prefix . 'terms';
	$table3 = $wpdb->prefix . 'term_taxonomy';
	$table4 = $wpdb->prefix . 'term_relationships';

	$tags  = $wpdb->get_results
	("
        SELECT DISTINCT terms2.term_id as tag_id, terms2.name as tag_name, terms2.slug as tag_slug, null as tag_link
        FROM
            `$table1` as p1
            LEFT JOIN `$table4` as r1 ON p1.ID = r1.object_ID
            LEFT JOIN `$table3` as t1 ON r1.term_taxonomy_id = t1.term_taxonomy_id
            LEFT JOIN `$table2` as terms1 ON t1.term_id = terms1.term_id,

            `$table1` as p2
            LEFT JOIN `$table4` as r2 ON p2.ID = r2.object_ID
            LEFT JOIN `$table3` as t2 ON r2.term_taxonomy_id = t2.term_taxonomy_id
            LEFT JOIN `$table2` as terms2 ON t2.term_id = terms2.term_id
        WHERE
            t1.taxonomy = 'category' AND p1.post_status = 'publish' AND terms1.term_id IN (" . $args['categories'] . ") AND
            t2.taxonomy = 'post_tag' AND p2.post_status = 'publish'
            AND p1.ID = p2.ID
        ORDER by tag_name
    ");
	$count = 0;
	foreach ($tags as $tag) {
		$tags[$count]->tag_link = get_tag_link($tag->tag_id);
		$count++;
	}
	return $tags;
}


/**
 * Lazy Load All Images
 * 
 * To Exclude, simply add this attr to img html: loading="not_lazy"
 *
 * @param string $html          Post thumbnail HTML
 * 
 * @return string Filtered post image HTML.
 */
add_filter('post_thumbnail_html', 'mhc22_add_lazy_load_tag_to_imgs', 10, 1);
add_filter('wp_get_attachment_image', 'mhc22_add_lazy_load_tag_to_imgs', 10, 1);
function mhc22_add_lazy_load_tag_to_imgs($html)
{

	if (!is_admin() && !str_contains(strtolower($html), 'loading="not_lazy"') && !str_contains(strtolower($html), 'featured-image')) {

		$html = str_replace(' src=', ' loading="lazy" data-lazy
		src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkqAcAAIUAgUW0RjgAAAAASUVORK5CYII=" 
		data-src=', $html);

	}
	return $html;
}

// 
add_filter('mce_buttons_2', 'mhc22_enable_mce_buttons');
function mhc22_enable_mce_buttons($buttons)
{
	$buttons[] = 'superscript';
	$buttons[] = 'subscript';

	return $buttons;
}


/**
 * Add robots:noindex tag to Attachment Pages
 */
add_filter('wpseo_robots', function ($robots) {

	if (is_attachment()) {
		return false;
	} else {
		return $robots;
	}

});

function custombtn($atts, $content = null)
{
	extract(
		shortcode_atts(
			array(
				'link'  => '#',
				'image' => ''
			),
			$atts
		)
	);

	return '<a target="_blank" rel="noopener" href="' . $link . '" class="btn-gradient">' . $content . ' <img src="https://wordpress-984514-3452657.cloudwaysapps.com/wp-content/uploads/2022/06/btn/icon-' . $image . '.png" width="64" height="28"></a>';
}
add_shortcode('btn', 'custombtn');


/**
 * Show all attachment URLs (to remove them from SERP via GSC Indexing API )
 * 
 * Using: https://developers.google.com/search/apis/indexing-api/v3/using-api#removing
 */
// add_action('init', function(){

// 	if( $_GET['dsjdfhsdjkgh'] == '239847923874' ){

// 		$args = array('post_type'=>'attachment','numberposts'=>999999999,'post_status'=>null,'posts_per_page'=>99999999);
// 		$attachments = get_posts($args);
// 		if($attachments){
// 			foreach($attachments as $attachment){
// 				echo get_permalink($attachment->ID); 
// 				echo "\n";
// 			}
// 		}

// 		exit;

// 	}

// });

// action add to <head>
// add_action('wp_head', 'mhc22_add_to_head');
function mhc22_add_to_head()
{ ?>
	<link rel="preload" href="<?= get_template_directory_uri(); ?>/fonts/GothamBook.woff2" as="font" type="font/woff2" crossorigin="anonymous">
	<link rel="preload" href="<?= get_template_directory_uri(); ?>/fonts/GothamMedium.woff2" as="font" type="font/woff2" crossorigin="anonymous">
	<link rel="preload" href="<?= get_template_directory_uri(); ?>/fonts/cormorantgaramond-medium-webfont.woff2" as="font" type="font/woff2" crossorigin="anonymous">
	<link rel="preload" href="<?= get_template_directory_uri(); ?>/fonts/GothamLight.woff2" as="font" type="font/woff2" crossorigin="anonymous">
<?php }

require_once get_stylesheet_directory() . '/inc/menu-builder.php';

// Clear cache endpoint
require_once get_stylesheet_directory() . '/inc/clear-cache.php';

// add to footer
add_action('wp_footer', 'tailwind_screen_sizes');
function tailwind_screen_sizes()
{ ?>
	<!-- <div class="fixed bottom-4 left-0">
		<div class="bg-black text-white p-4 sm:hidden">XS</div>
		<div class="bg-black text-white p-4 hidden sm:block md:hidden">SM</div>
		<div class="bg-black text-white p-4 hidden md:block lg:hidden">MD</div>
		<div class="bg-black text-white p-4 hidden lg:block xl:hidden">LG</div>
		<div class="bg-black text-white p-4 hidden xl:block">XL</div>
	</div> -->
<?php }