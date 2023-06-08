<?php
$id      = 'partners-logo'; // $block['id']
$en_gray = (get_field('enable_gray_box_plb') == 1 ? 'bg-light ' : 'bg-white ');
$classes = 'partners-logo splide pt-8 pb-14 ' . $en_gray;
if (!empty($block['className'])) {
	$classes .= $block['className'];
}
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>" aria-label="Partners Logo">
	<div class="max-w-7xl px-5 mx-auto">

		<?php if (get_field('enable_title_plb') == 1):
			if (have_rows('title_plb')):
				while (have_rows('title_plb')):
					the_row(); ?>
					<h3 class="sec-heading text-xs font-bold font-g-book uppercase tracking-widest <?php echo get_sub_field('align') == 'center' ? 'text-center ' : 'text-left '; ?>mb-10 relative after:content-[''] after:w-full after:h-px after:bg-[#979797]/[.3] after:absolute after:left-0 after:top-2/4">
						<span class="<?php echo $en_gray; ?> <?php echo get_sub_field('align') == 'center' ? 'px-4 ' : 'pr-4 '; ?>inline-block relative z-[1]"><?php the_sub_field('heading'); ?></span>
					</h3>
				<?php endwhile;
			endif;
		endif; ?>

		<?php if (have_rows('add_logos_plb')): ?>
			<ul class="snap-x flex flex-nowrap gap-4 items-center overflow-scroll no-scrollbar">

				<?php while (have_rows('add_logos_plb')):
					the_row(); ?>
					<li class="snap-center p-1 shrink-0">
						<?php echo wp_get_attachment_image(get_sub_field('image'), 'full', "", array("class" => "max-h-16 w-full object-contain")); ?>
					</li>
				<?php endwhile; ?>

			</ul>
		<?php endif; ?>

	</div>
</section>