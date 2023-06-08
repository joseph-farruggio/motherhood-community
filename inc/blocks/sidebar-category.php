<?php
$id = 'custom-category-posts sidebar-category-' . $block['id'];
$classes = 'sidebar-category widget widget_block ';
if( !empty($block['className']) ) {
    $classes .= $block['className'];
}

$post_id = get_queried_object_id();
$category = null;
$title = get_field('heading_scb');
$limit = get_field('nop_scb');

$args = [
    'post__not_in'          => [$post_id],
    'posts_per_page'        => $limit,
    'ignore_sticky_posts'   => 1,
    'orderby'               => 'modified',
    'no_found_rows'         => true,
];

$cats = get_categories(['object_ids' => $post_id]);
if( count($cats) ) {
    $term_id = 0;
    foreach($cats as $cat) {
        if( $term_id ) continue;
        if( $cat->parent > 0 ){
            $term_id = $cat->term_id;
            $category = $cat;
        }
    }

    if( !$term_id ) {
        $term_id = $cats[0]->term_id;
        $category = $cats[0];
    }

    $title = !empty( $title ) ? $title : __($category->name, 'mhc22');
    $args['tax_query'] = [
        [
            'taxonomy' => 'category',
            'terms' => $category->term_id,
            'include_children' => false
        ]
    ];

} else {
    $title = !empty( $title ) ? $title : __('All Posts', 'mhc22');
}
$related_query = new WP_Query($args);
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">
    <h3 class="widgettitle flex items-center justify-between font-g-medium text-base text-[#353535] uppercase py-5 cursor-pointer tracking-[0.098rem]">
        <span><?php echo $title ?></span>
        <?php icon_arrowd(); ?>
    </h3>
    <ul class="menu">
        <?php if( $related_query->have_posts() ): $related_posts = $related_query->posts; ?>
            <?php foreach( $related_posts as $_post ): ?>
            <li class="menu-item px-2 border-b border-[#e6e6e6] block">
                <a href="<?php echo get_permalink($_post->ID) ?>" class="py-2.5 text-black capitalize text-sm font-g-book block hover:text-[#28bed7]"><?php _e($_post->post_title, 'mhc22'); ?></a>
            </li>
            <?php endforeach; wp_reset_postdata(); ?>
        <?php endif; ?>

        <?php if(!is_null($category) ): ?>
            <?php if( $category->count > $limit ):?>
            <li class="menu-item px-2 border-b border-[#e6e6e6] block">
                <a href="<?php echo get_category_link($category->term_id) ?>" class="py-2.5 text-black capitalize text-sm font-g-book block hover:text-[#28bed7]"><?php _e('See all', 'mhc22'); ?></a>
            </li>
            <?php endif; ?>
        <?php endif; ?>
    </ul>
</section>