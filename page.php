<?php get_header(); ?>

<div class="container mx-auto mt-14 mb-8 px-4">

	<div class="flex flex-col lg:flex-row justify-center gap-x-16">
		<div class="max-w-3xl w-full">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'template-parts/content', get_post_format() ); ?>

				<?php //echo get_post_format(). ' sss '; endwhile; ?>
			<?php echo get_post_format(); endwhile; ?>
			<?php endif; ?>
		</div>

		<div class="lg:w-[24rem] w-full">
			<?php get_sidebar(); ?>
		</div>
	</div>

</div>

<?php
get_footer();