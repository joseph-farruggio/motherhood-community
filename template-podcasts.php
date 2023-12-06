<?php 
// Template Name: Podcasts 
get_header(); ?>

<div class="container mx-auto mt-14 mb-8 px-4">

    <h1 class="entry-title text-center font-cg-medium text-3xl md:text-6xl text-[#161616] mb-10 md:mb-[4.688rem]"><?php _e('Podcasts', 'mhc22'); ?></h1>
	<div class="flex flex-col lg:flex-row justify-center gap-x-16">
		<div class="max-w-3xl w-full">
			<?php
            $the_query = new WP_Query([
                'post_type'     => 'podcasts',
                'post_status'   => 'publish',
            ]);

            if( $the_query->have_posts() ):
                while( $the_query->have_posts() ) : $the_query->the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" class="card group flex flex-col sm:flex-row gap-0 md:gap-4 lg:gap-8 mb-6">
					<div class="image w-full sm:w-5/12 relative">
						<?php if( has_post_thumbnail() ): ?>
						<a href="<?php the_permalink(); ?>" class="block overflow-hidden">
							<?php the_post_thumbnail( 'image-764x480', ['class' => 'w-full transition ease-linear group-hover:scale-125'] ); ?>
						</a>
						<?php endif; ?>
					</div>
                    <div class="content w-full sm:w-7/12 p-5 sm:p-4">
                        <h5 class="text-3xl uppercase font-g-medium font-normal mb-4">
							<?php the_category( ' / ' ); ?>
						</h5>
						<h2 class="text-[2rem] leading-[2rem] md:text-5xl font-avenir font-medium tracking-tighter mb-4">
							<a href="<?php the_permalink(); ?>" class="text-secondary block underline"><?php the_title(); ?></a>
						</h2>
                        
                    </div>
                </article>
                <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
		</div>

		<div class="lg:w-[24rem] w-full">
			<?php get_sidebar(); ?>
		</div>
	</div>

</div>

<?php get_template_part( 'template-parts/section/content', 'as_seen_on' ); ?>

<?php
get_footer();