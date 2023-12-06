<?php get_header(); ?>

	<div class="max-w-7xl mx-auto">
    <?php if ( have_posts() ) : ?>

        <header class="page-header mb-10">
            <?php bt_breadcrumbs(); ?>
            <h1 class="search-title font-cg-medium text-3xl md:text-6xl text-[#666666]">
                <?php _e( 'Search results for: ', 'mhc22' ); ?>
                <span class="page-description"><?php echo get_search_query(); ?></span>
            </h1>
        </header><!-- .page-header -->

        <?php
        echo '<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-8 gap-y-4">';
        while ( have_posts() ) : the_post();
            $terms = get_the_terms(get_the_ID(), 'post_tag');
            $terms = join(' ', wp_list_pluck($terms, 'slug'));

            // get_template_part( 'template-parts/content', get_post_format() );
            ?>
            <div class="tags_posts text-left <?php echo $terms; ?>">
				<a href="<?php the_permalink(); ?>" class="block relative">
                    <?php the_post_thumbnail( 'image-284x180' ); ?>
				</a>
				<div class="content py-4 relative">
					<h5 class="text-sm tracking-[.084rem] uppercase font-g-medium font-normal mb-4">
                        <?php the_category( ' / ' ); ?>
					</h5>
					<h2 class="text-lg md:text-[2rem] md:leading-[2.25rem] font-cg-medium font-medium -tracking-[.015rem] mb-10">
						<a href="<?php the_permalink(); ?>" class="text-primary hover:text-secondary block"><?php the_title(); ?></a>
					</h2>
                    <p class="text-sm font-g-light text-[#353535] mb-4"><?php echo wp_trim_words( strip_shortcodes( get_the_content() ), 20, '...' );?></p>
					
				</div>
			</div>
            <?php

        endwhile;
        wp_reset_postdata();
        echo '</div>';

    else :
        get_template_part( 'template-parts/content', 'none' );

    endif;
    ?>
	</div><!-- #primary -->

<?php
get_footer();
