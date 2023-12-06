<?php
$id      = 'grid3-posts-' . $block['id'];
$en_gray = (get_field('enable_gray_box_g3pb') == 1 ? 'bg-light ' : 'bg-white ');
$classes = 'grid3-posts ' . $en_gray;
if (!empty($block['className'])) {
	$classes .= $block['className'];
}
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">
	<div class="max-w-7xl pt-6 px-5 mx-auto">

		<div class="flex flex-col xlg:flex-row gap-8">

			<div class="w-full lg:w-4/6">

				<?php if (get_field('enable_title_g3pb') == 1):
					if (have_rows('title_g3pb')):
						while (have_rows('title_g3pb')):
							the_row(); ?>
							<h3 class="sec-heading text-xs font-bold font-g-book uppercase tracking-widest <?php echo get_sub_field('align') == 'center' ? 'text-center ' : 'text-left '; ?>mb-10 relative after:content-[''] after:w-full after:h-px after:bg-[#979797]/[.3] after:absolute after:left-0 after:top-2/4">
								<span class="<?php echo $en_gray; ?> <?php echo get_sub_field('align') == 'center' ? 'px-4 ' : 'pr-4 '; ?>inline-block relative z-[1]"><?php the_sub_field('heading'); ?></span>
							</h3>
						<?php endwhile;
					endif;
				endif; ?>

				<?php
				$disable_lazy = get_field('disable_img_lazyload_g3pb');
				$post_ids     = get_field('select_posts_g3pb');
				$the_query    = new WP_Query(
					array(
						'post_type'      => 'post',
						'post_status'    => 'publish',
						'posts_per_page' => 3,
						'post__in'       => ((!isset($post_ids) || empty($post_ids)) ? array(-1) : $post_ids)
					)
				);

				if ($the_query->have_posts()): ?>

					<div id="grid3-posts">
						<ul class="grid sm:grid-cols-2 sm:gap-6">
							<?php while ($the_query->have_posts()):
								$the_query->the_post(); ?>
								<li class="">
									<div class="">
										<?php if (has_post_thumbnail()): ?>
											<a href="<?php the_permalink(); ?>" class="block">
												<?php
												$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'image-384x256');

												echo '<img' . ($disable_lazy == 1 ? ' loading="not_lazy"' : '') . ' src="' . esc_url($image[0]) . '" width="' . $image[1] . '" height="' . $image[2] . '" alt="' . get_the_title() . '" />';
												?>
											</a>
										<?php endif; ?>

										<div class="content pt-6">
											<h5 class="text-xs uppercase font-g-medium font-normal mb-4">
												<?php the_category(' / '); ?>
											</h5>
											<h2 class="text-[2rem] leading-[2rem] font-cg-medium font-medium tracking-tighter mb-10">
												<a href="<?php the_permalink(); ?>" class="text-primary hover:text-secondary block"><?php the_title(); ?></a>
											</h2>
											
										</div>
									</div>
								</li>
							<?php endwhile;
							wp_reset_postdata(); ?>
						</ul>
					</div>

				<?php endif; ?>

			</div>


			<div id="sponsor-sidebar" class="sidebar w-full lg:w-2/6 ">
				<div class="sidebar-signup"><?php echo do_shortcode('[mailerlite_form form_id=1]'); ?></div>
			</div>

		</div>
	</div>
</section>
<style>
	.card-posts #sponsor-sidebar {
		display: none !important;
	}

	@media (min-width: 639px) {
		.grid3-posts .splide__slide {
			width: calc(((100% + 2rem) / 2) - 2rem) !important;
		}
	}
</style>