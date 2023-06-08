<aside id="sidebar-single" class="sidebar h-full">

    <div>
        <?php get_template_part('template-parts/sidebar/content', 'author'); ?>
		<div class="ml-embedded" data-form="eRTC9i"></div>
    </div>

    <?php
    if ( is_active_sidebar( 'post-sidebar' ) ) {
        if( is_singular('product') || is_singular('podcasts') ) {
            dynamic_sidebar( 'post-sidebar-2' );
        } else {
            dynamic_sidebar( 'post-sidebar' );
        }
    }
    ?>

    <div>
        <?php get_template_part('template-parts/sidebar/content', 'featured_posts'); ?>
    </div>

</aside>