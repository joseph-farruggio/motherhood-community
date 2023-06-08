<?php 
$id = 'card-posts-' . $block['id'];
$en_gray = (get_field('enable_gray_box_cpb') == 1 ? 'bg-light ' : 'bg-white ');
$classes = 'card-posts ' . $en_gray;
if( !empty($block['className']) ) {
    $classes .= $block['className'];
}
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">
	<div class="max-w-7xl px-[.9375rem] xlg:px-5 mx-auto">

		<?php
		$nop = get_field('posts_per_page_cpb');
		$args = array(
			'post_type'			=> 'post',
			'post_status'		=> 'publish',
			'offset'			=> 5, 
			'posts_per_page'	=> ($nop != '' ? $nop : 5)
		);

		if( get_field('select_posts_by_cpb') == 'postid' ) {
			$post_ids = get_field('select_posts_cpb');
			$args['post__in'] = ((!isset($post_ids) || empty($post_ids)) ? array(-1) : $post_ids);
		} elseif( get_field('select_posts_by_cpb') == 'modified' ) {
			$args['orderby'] = 'modified';
		}

		$the_query = new WP_Query( $args );
		?>

		<div class="flex flex-col xlg:flex-row gap-8">

			<?php if( $the_query->have_posts() ): ?>
			<div class="<?php echo (get_field('enable_sidebar_cpb') == 1 ? 'w-full lg:w-4/6' : 'w-full'); ?>">

				<?php if(get_field('enable_title_cpb') == 1):
					if( have_rows('title_cpb') ):
						while( have_rows('title_cpb') ) : the_row(); ?>
						<h3 class="block sec-heading text-sm xlg:text-xs font-bold font-g-book uppercase tracking-widest <?php echo get_sub_field('align') == 'center' ? 'text-center ' : 'text-left '; ?>mb-10 relative after:content-none xlg:after:content-[''] after:w-full after:h-px after:bg-[#979797]/[.3] after:absolute after:left-0 after:top-2/4">
							<span class="<?php echo $en_gray; ?> <?php echo get_sub_field('align') == 'center' ? 'px-4 ' : 'pr-4 '; ?>inline-block relative z-[1]"><?php the_sub_field('heading'); ?></span>
						</h3>
						<?php endwhile;
					endif;
				endif; ?>

				<?php while( $the_query->have_posts() ) : $the_query->the_post();  ?>
				<div class="card group flex flex-col sm:flex-row gap-0 md:gap-4 lg:gap-8 mb-6">
					<div class="image w-full sm:w-5/12 relative">
						<?php if( has_post_thumbnail() ): ?>
						<a href="<?php the_permalink(); ?>" class="block overflow-hidden">
							<?php the_post_thumbnail( 'image-320x280', ['class' => 'w-full transition ease-linear group-hover:scale-125'] ); ?>
						</a>
						<?php endif; ?>
					</div>
					<div class="content w-full sm:w-7/12 p-5 sm:p-4">
						<h5 class="text-sm uppercase font-g-medium font-normal mb-4">
							<?php the_category( ' / ' ); ?>
						</h5>
						<h2 class="text-2xl sm:text-[2rem] sm:leading-[2rem] font-cg-medium font-medium tracking-tighter mb-4">
							<a href="<?php the_permalink(); ?>" class="text-primary hover:text-secondary block"><?php the_title(); ?></a>
						</h2>
						<p class="text-sm font-g-light text-[#353535] mb-4"><?php echo wp_trim_words( strip_shortcodes( get_the_content() ), 20, '...' );?></p>
						<h6 class="uppercase font-g-medium text-xs text-[#1e353d]/[.37]">
							<?php echo do_shortcode('[rt_reading_time label="" postfix="minute read"]'); ?>
						</h6>
					</div>
				</div>
				<?php endwhile; wp_reset_postdata(); ?>

			</div>
			<?php endif; ?>

			<?php if( get_field('enable_sidebar_cpb') == 1 ): ?>
			<div id="sponsor-sidebar" class="sidebar w-full lg:w-2/6 ">
				<?php get_template_part('template-parts/sidebar/content', 'signup'); ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>