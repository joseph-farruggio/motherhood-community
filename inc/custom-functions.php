<?php

function mhc_excerpt()
{
	$excerpt = get_the_content();
	$excerpt = preg_replace(" (\[.*?\])", '', $excerpt);
	$excerpt = strip_shortcodes($excerpt);
	$excerpt = strip_tags($excerpt);
	$excerpt = substr($excerpt, 0, 250);
	$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
	$excerpt = trim(preg_replace('/\s+/', ' ', $excerpt));
	//$excerpt = $excerpt.'... <a href="'.$permalink.'">more</a>';
	return $excerpt;
}

function icon_burger_menu()
{
	echo '<svg viewBox="0 0 20 20" class="inline-block w-6 h-6" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g stroke="none" stroke-width="1" fill="currentColor" fill-rule="evenodd"><g id="icon-shape"> <path d="M0,3 L20,3 L20,5 L0,5 L0,3 Z M0,9 L20,9 L20,11 L0,11 L0,9 Z M0,15 L20,15 L20,17 L0,17 L0,15 Z" id="Combined-Shape"></path></g></g></svg>';
}

function icon_search()
{
	echo '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" /></svg>';
}

function icon_x()
{
	echo '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>';
}

function icon_arrowd()
{
	echo '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#161616" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" /></svg>';
}

function bt_set_post_views($post_id)
{
	$count_key = 'wpb_post_views_count';
	$count     = get_post_meta($post_id, $count_key, true);

	if ($count == '') {
		$count = 0;
		delete_post_meta($post_id, $count_key);
		add_post_meta($post_id, $count_key, '0');
	} else {
		$count++;
		update_post_meta($post_id, $count_key, $count);
	}
}

/***
 * Shortcodes
 * 
 * @param array $atts
 *	1. product_id = integer
 * how to use:
 * [product_card product_id="1"]
 */
add_shortcode('product_card', '_product_card');
function _product_card($atts)
{

	if (ICL_LANGUAGE_CODE == 'es') {
		$atts = shortcode_atts(
			array(
				'spanish_product_id'      => 0,
				'affiliate_link_override' => '',
			),
			$atts,
			'product_card'
		);

		$product_id = $atts['spanish_product_id'];
	} else {
		$atts = shortcode_atts(
			array(
				'product_id'              => 0,
				'affiliate_link_override' => '',
			),
			$atts,
			'product_card'
		);

		$product_id = $atts['product_id'];
	}


	if (is_numeric($atts['product_id'])) {
		$product_id = $atts['product_id'];

		if (!absint($product_id))
			return;

		$product = get_post($product_id);
	} else {
		$product_slug = $atts['product_id'];


		global $wpdb;
		$table_name = $wpdb->prefix . "postmeta";

		$sql = "SELECT post_id from $table_name WHERE meta_key='shortcode_value' AND meta_value='$product_slug' ";

		$result = $wpdb->get_row($sql);

		$product_id = $result->post_id;

		if (!absint($product_id))
			return;

		$product = get_post($product_id);
	}

	$product = get_post($product_id);

	$affiliate_link = $atts['affiliate_link_override'];

	$eval_scores = [
		'value_for_money_price_score'    => get_field_object('value_for_money_price_score', $product_id),
		'quality_score'                  => get_field_object('quality_score', $product_id),
		'strength_score'                 => get_field_object('strength_score', $product_id),
		'customer_service_score'         => get_field_object('customer_service_score', $product_id),
		'lab_testing_transparency_score' => get_field_object('lab_testing_transparency_score', $product_id),
		'effectiveness_score'            => get_field_object('effectiveness_score', $product_id),
	];

	$cwy_score    = get_field_object('cwy_score', $product_id);
	$editors_pick = get_field_object('editors_pick', $product_id);


	$override_gen_prod_features = get_field('override_gen_prod_features', $product_id);
	if ($override_gen_prod_features == true) {
		$key = $product_id;
	} else {
		$key = "options";
	}

	$features = [
		'discount_pricing_available'    => get_field_object('discount_pricing_available', $key),
		'source_of_hemp'                => get_field_object('source_of_hemp', $key),
		'form'                          => get_field_object('form', $key),
		'ingredients'                   => get_field_object('ingredients', $key),
		'type_of_cbd'                   => get_field_object('type_of_cbd', $key),
		'extraction_method'             => get_field_object('extraction_method', $key),
		'how_to_take_it'                => get_field_object('how_to_take_it', $key),
		'potency_cbd_per_bottle'        => get_field_object('potency_cbd_per_bottle', $key),
		'thc_content_percent'           => get_field_object('thc_content_percent', $key),
		'carrier_oil'                   => get_field_object('carrier_oil', $key),
		'cbd_concentration_per_serving' => get_field_object('cbd_concentration_per_serving', $key),
		'drug_test'                     => get_field_object('drug_test', $key),
		'lab_results'                   => get_field_object('lab_results', $key),
		'flavours'                      => get_field_object('flavours', $key),
		'price_range'                   => get_field_object('price_range', $key),
		'price_mg_cbd'                  => get_field_object('price_mg_cbd', $key),
		'shipping_time_to_delivery'     => get_field_object('shipping_time_to_delivery', $key),
		'guarantee'                     => get_field_object('guarantee', $key),
		'lab_testing_transparency'      => get_field_object('lab_testing_transparency', $key),
		'contaminants'                  => get_field_object('contaminants', $key),
		'allergens'                     => get_field_object('allergens', $key),
		'refund_policy'                 => get_field_object('refund_policy', $key),
		'customer_service'              => get_field_object('customer_service', $key),
		'recommended_for'               => get_field_object('recommended_for', $key),
		'countries_served'              => get_field_object('countries_served', $key),
	];

	$html = "";
	ob_start();
	include get_stylesheet_directory() . '/template-parts/shortcodes/content-product_card.php';
	$html = ob_get_clean();

	return $html;
}

/**
 * 
 * @param array $atts
 *	1. product_ids = string, comma delimited product ids  
 * how to use:
 * [compare_product_cards product_id="1,2,3"]
 */
add_shortcode('compare_product_cards', '_compare_product_card');
function _compare_product_card($atts)
{
	// if constant is defined
	if (defined(ICL_LANGUAGE_CODE)) {
		if (ICL_LANGUAGE_CODE == 'es') {
			$atts = shortcode_atts(
				array(
					'spanish_product_ids'     => "",
					'affiliate_link_override' => '',
				),
				$atts,
				'product_card'
			);

			$product_ids     = array_map('intval', explode(',', $atts['product_ids']));
			$affiliate_links = explode(',', $atts['affiliate_link_override']);
		}
	} else {
		$atts = shortcode_atts(
			array(
				'product_ids'             => "",
				'affiliate_link_override' => '',
			),
			$atts,
			'product_card'
		);

		$product_ids     = array_map('intval', explode(',', $atts['product_ids']));
		$affiliate_links = explode(',', $atts['affiliate_link_override']);
	}



	$check_if_num = explode(',', $atts['product_ids']);
	if (is_numeric($check_if_num[0])) {
		$product_ids = array_map('intval', explode(',', $atts['product_ids']));
		if (!count($product_ids))
			return;

	} else {
		global $wpdb;
		$table_name   = $wpdb->prefix . "postmeta";
		$product_ids  = [];
		$product_slug = explode(',', $atts['product_ids']);
		foreach ($product_slug as $slug) {
			$sql = "SELECT post_id from $table_name WHERE meta_key='shortcode_value' AND meta_value='$slug' ";

			$result = $wpdb->get_row($sql);

			$product_ids[] = $result->post_id;
		}
	}

	$_products = [];
	foreach ($product_ids as $pid) {
		if ($pid) {
			$_products[] = get_post($pid);
		}
	}
	if (!count($_products))
		return;

	$table_rows = ["", "", "MC Score", "Therapeutic grade?", "Organic or Wild-Crafted?", "Chemical Free", "Testing available?"];
	$comparison = [];
	foreach ($table_rows as $x => $row_label):
		$row_data = [];
		if (0 == $x or 1 == $x) {
			$row_data[] = "";
		} else {
			$row_data[] = $row_label;
		}
		$count = 0;
		foreach ($_products as $_product) {

			if (0 == $x) {
				// image
				if ($affiliate_links[$count]) {
					$prod_link = $affiliate_links[$count];
				} else {
					$prod_link = get_field('latest_price_button_link', $_product->ID);
				}
				$row_data[] = '<a href="' . $prod_link . '">' . get_the_post_thumbnail($_product) . '</a>';
			} else if (1 == $x) {
				if ($affiliate_links[$count]) {
					$prod_link = $affiliate_links[$count];
				} else {
					$prod_link = get_field('latest_price_button_link', $_product->ID);
				}
				$row_data[] = '<p class="brand-name">' . get_the_title($_product->ID) . '</p>' . '<a href="' . $prod_link . '" class="btn">Shop</a>';
			} else if (2 == $x) {
				$row_data[] = get_field('cwy_score', $_product->ID) . '%';
			} else if (3 == $x) {
				$row_data[] = get_field('therapeutic_grade', $_product->ID);
			} else if (4 == $x) {
				$row_data[] = get_field('organic', $_product->ID);
			} else if (5 == $x) {
				$row_data[] = get_field('chemical-free', $_product->ID);
			} else if (6 == $x) {
				$row_data[] = get_field('testing_available', $_product->ID);
			}
			$count++;
		}

		$comparison[] = $row_data;
	endforeach;

	$html = "";
	ob_start();
	include get_stylesheet_directory() . '/template-parts/shortcodes/content-compare_product_card.php';
	$html = ob_get_clean();

	return $html;
}

/**
 * 
 * @param array $atts
 *	1. product_id = integer 
 * 	2. type = string (default: empty)
 *				could be:
 *					- editors_pick
 * how to use:
 * [mini_product_card product_id="1"] or [mini_product_card product_id="1" type="editors_pick"]
 */
add_shortcode('mini_product_card', '_mini_product_card');
function _mini_product_card($atts)
{

	$atts = shortcode_atts(
		array(
			'product_id'              => 0,
			'type'                    => '',
			'affiliate_link_override' => '',
		),
		$atts,
		'product_card'
	);

	$product_id = $atts['product_id'];


	if (is_numeric($atts['product_id'])) {
		$product_id = $atts['product_id'];


		if (!absint($product_id))
			return;

		$product = get_post($product_id);

	} else {
		$product_slug = $atts['product_id'];

		global $wpdb;
		$table_name = $wpdb->prefix . "postmeta";

		$sql = "SELECT post_id from $table_name WHERE meta_key='shortcode_value' AND meta_value='$product_slug' ";

		$result = $wpdb->get_row($sql);

		$product_id = $result->post_id;

		if (!absint($product_id))
			return;

		$product = get_post($product_id);
	}

	$affiliate_link = $atts['affiliate_link_override'];

	$type = $atts['type'];

	$section_cls = ('editors_pick' == $type) ? 'editors-pick' : '';

	$html = "";
	ob_start();
	include get_stylesheet_directory() . '/template-parts/shortcodes/content-mini_product_card.php';
	$html = ob_get_clean();

	return $html;
}

// 
add_filter('rtwp_filter_wordcount', 'mhc_custom_wordcount');
function mhc_custom_wordcount($word_count)
{
	global $post;
	$fullwidth_content = "";
	if (have_rows('flexible_content', $post)):
		while (have_rows('flexible_content', $post)):
			the_row();
			if (get_row_layout() == 'fullwidth_content'):
				$fullwidth_content = get_sub_field('content');
			endif;
		endwhile;
	endif;

	if (get_field('more_info', $post)) {
		$rt_content = get_field('more_info', $post);
	} elseif ($fullwidth_content) {
		$rt_content = $fullwidth_content;
	} else {
		$rt_content = get_post_field('post_content', $post);
	}

	$number_of_images = substr_count(strtolower($rt_content), '<img ');

	$rt_content = wp_strip_all_tags($rt_content);
	$word_count = count(preg_split('/\s+/', $rt_content));

	return $word_count;
}

// 
add_shortcode('alphabet_nav', 'mc_alphabet_nav_func');
function mc_alphabet_nav_func($atts)
{

	$atts = shortcode_atts([
		'list' => 'a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z'
	], $atts);

	$lists = explode(',', $atts['list']);

	ob_start();
	if (!empty($lists)) {
		echo '<div class="alphabet-sticky-toggle flex sm:hidden py-5 sticky top-0 z-[9] bg-white"><a href="javascript:;" class="inline-block ml-auto">';
		icon_burger_menu();
		echo '</a></div>';
		echo '<ul class="block-editor-block-variation-picker__variations alphabet-sticky flex flex-col sm:flex-row gap-2 text-sm uppercase bg-white py-5 fixed sm:sticky top-0 z-[9] transition-all -translate-x-full sm:translate-x-0 h-full sm:h-auto w-[30%] sm:w-auto left-0 sm:left-auto">';
		foreach ($lists as $l) {
			echo '<li><a href="#starting_with_' . strtolower($l) . '" class="px-4 sm:px-1 p-1 block sm:inline-block !border-transparent hover:!border-[#28bed7]">' . $l . '</a></li>';
		}
		echo '</ul>';
	}
	return ob_get_clean();
}

// 
add_shortcode('alphabet_hook', 'mc_alphabet_hook_func');
function mc_alphabet_hook_func($atts)
{

	$atts = shortcode_atts([
		'target' => ''
	], $atts);

	ob_start();
	if (!empty($atts['target'])) {
		echo '<div id="starting_with_' . strtolower($atts['target']) . '" class="text-3xl mb-8"></div>';
	}
	return ob_get_clean();
}