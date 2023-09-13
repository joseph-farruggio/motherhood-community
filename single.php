<?php get_header();

bt_set_post_views(get_the_ID()); ?>

<div class="xl:container mx-auto mt-8 lg:mt-14 mb-8 px-4">

	<!-- [@media(min-width:1270px)]:flex-row -->
	<div class="flex justify-center flex-col lg:flex-row gap-x-16">
		<div class="max-w-3xl w-full shrink">

			<?php
			if (have_posts()):
				while (have_posts()):
					the_post();
					get_template_part('template-parts/content', 'single');
				endwhile;
			endif;
			?>

			<?php if (get_field('affdisclaimer_fmcoptions', 'option')): ?>
				<cite class="block mt-10 text-[#9ca3af]">
					<?php the_field('affdisclaimer_fmcoptions', 'option'); ?>
				</cite>
			<?php endif; ?>

		</div>

		<div class="lg:w-[24rem] max-w-full w-full mb-5 lg:mb-0">
			<?php
			if (!is_singular('podcasts')) {
				get_sidebar('single');
			}
			?>
		</div>
	</div>

</div>

<?php
get_template_part('template-parts/section/content', 'related_posts');
get_template_part('template-parts/section/content', 'as_seen_on');

get_footer();