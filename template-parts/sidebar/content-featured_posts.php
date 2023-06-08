<?php
$post_id    = get_queried_object_id();
$cat_id     = get_the_category( $post_id );
$cat_id     = $cat_id[0]->cat_ID;
?>

<section id="sidebar-featured-post" class="sidebar-featured-post splide" aria-label="Featured Posts">

    <h3 class="flex items-center justify-between font-g-medium text-base text-[#353535] uppercase py-5 tracking-[0.098rem]">
        <span><?php _e('Featured Posts', 'mhc22'); ?></span>
    </h3>

    <?php
    $posts = [];
    if( get_field('featured_post') ) {
        $row = get_field('featured_post', $post_id);

        foreach($row as $single) {
            $posts[] = $single['post'];
        }

    } elseif( get_field('featured_posts_cat', 'term_' . $cat_id) ) {
        $row = get_field('featured_posts_cat', 'term_' . $cat_id);

        foreach($row as $single) {
            $posts[] = $single['post_cat'];
        }

    } elseif( get_field('featured_post_global', 'options') ) {
        $row = get_field('featured_post_global', 'options');

        foreach($row as $single) {
            $posts[] = $single['post_global'];
        }

    }
    ?>

    <?php 
    if( !empty($posts) ):
        echo '<div class="splide__track"><ul class="splide__list">';
        foreach($posts as $single_post): 
        $post_link = esc_url(get_permalink($single_post->ID)); ?>
        <li class="splide__slide w-fit">
            <?php if( has_post_thumbnail($single_post->ID) ): ?>
            <a href="<?php echo $post_link; ?>" class="block">
                <?php echo get_the_post_thumbnail($single_post->ID, 'image-384x256'); ?>
            </a>
            <?php endif; ?>

            <div class="content pt-4">
                <h2 class="text-[2rem] leading-[2rem] font-cg-medium font-medium -tracking-[.43px] mb-4">
                    <a href="<?php echo $post_link; ?>" class="text-primary hover:text-secondary block"><?php _e($single_post->post_title, 'mhc22'); ?></a>
                </h2>
                <h6 class="uppercase font-g-medium text-xs text-[#1e353d]/[.37] mb-2"><?php echo do_shortcode('[rt_reading_time label="" postfix="minute read" post_id="'. $single_post->ID .'"]'); ?></h6>
                <p class="text-lg font-g-light text-[#353535]"><?php _e(wp_trim_words( strip_shortcodes( $single_post->post_content ), 20, '...' ), 'mhc22');?></p>
                <a href="<?php echo $post_link; ?>" class="read-more text-xs text-secondary uppercase"><?php _e('Read More', 'mhc22'); ?></a>
            </div>
        </li>
        <?php
        endforeach;
        wp_reset_postdata();
        echo '</ul></div>';
    endif; ?>

</section>