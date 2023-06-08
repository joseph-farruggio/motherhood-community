<aside id="sponsor-sidebar" class="sidebar h-full">
    <div class="sticky top-20">

        <?php 
        if( get_field('select_sidebar_gpo') == 'featured' ) {
            get_template_part('template-parts/sidebar/content', 'featured_posts');
        } else {
            get_template_part('template-parts/sidebar/content', 'signup');
        }
        ?>

    </div>
</aside>