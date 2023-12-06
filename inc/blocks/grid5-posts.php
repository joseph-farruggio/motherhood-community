<?php 
$id = 'grid5-posts-' . $block['id'];
$en_gray = (get_field('enable_gray_box_g5pb') == 1 ? 'bg-light ' : 'bg-white ');
$classes = 'grid5-posts ' . $en_gray;
if( !empty($block['className']) ) {
    $classes .= $block['className'];
}
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">
	<div class="max-w-7xl px-5 mx-auto">

		<?php if(get_field('enable_title_g5pb') == 1):
			if( have_rows('title_g5pb') ):
				while( have_rows('title_g5pb') ) : the_row(); ?>
				<h3 class="block sec-heading text-sm xlg:text-xs font-bold font-g-book uppercase tracking-widest <?php echo get_sub_field('align') == 'center' ? 'text-center ' : 'text-left '; ?>mb-10 relative after:content-none xlg:after:content-[''] after:w-full after:h-px after:bg-[#979797]/[.3] after:absolute after:left-0 after:top-2/4">
					<span class="<?php echo $en_gray; ?> <?php echo get_sub_field('align') == 'center' ? 'px-4 ' : 'pr-4 '; ?>inline-block relative z-[1]"><?php the_sub_field('heading'); ?></span>
				</h3>
				<?php endwhile;
			endif;
		endif; ?>

		<?php
		$nop = get_field('posts_per_page_g5pb');
		$args = array(
			'post_type'			=> 'post',
			'post_status'		=> 'publish',
			'posts_per_page'	=> ($nop != '' ? $nop : 5)
		);

		if( get_field('select_posts_by_g5pb') == 'postid' ) {
			$post_ids = get_field('select_posts_g5pb');
			$args['post__in'] = ((!isset($post_ids) || empty($post_ids)) ? array(-1) : $post_ids);
		} elseif( get_field('select_posts_by_g5pb') == 'popular' ) {
			$args['meta_key'] = 'wpb_post_views_count';
			 $args['orderby'] = 'meta_value_num'; 
		//	$args['orderby'] = array('meta_value','meta_value_num');
			$args['order'] = 'DESC';
		}
		
		$the_query = new WP_Query( $args );
	 
				if(is_user_logged_in()){ 
					if( get_field('select_posts_by_g5pb') == 'popular' ) {
						/* echo '<pre> Arguments: ';
						var_dump($args);
						echo '</pre>'; */
					}
				} 
				
				
		
		
		if( $the_query->have_posts() ): ?>

		<div class="grid grid-cols-1 md:grid-cols-5 gap-y-4 md:gap-y-0 gap-x-4">

            <?php $x = 1; while( $the_query->have_posts() ) : $the_query->the_post();  ?>
			<div class="card flex flex-row md:flex-col space-x-3 md:space-x-0 text-left md:text-center">
				<a href="<?php the_permalink(); ?>" class="block w-[45%] md:w-full relative h-full md:h-auto">
                    <?php the_post_thumbnail( 'image-235x155' ); ?>

					<span class="w-[40px] h-[40px] md:w-[70px] md:h-[70px] bg-white font-cg-medium text-[2rem] text-[#161616] text-center rounded-full absolute top-1/2 md:top-auto -translate-y-1/2 md:-translate-y-auto grid place-content-center md:left-2/4 md:bottom-[-60px] md:-ml-[35px] right-[-20px] md:right-auto"><?php echo $x; ?></span>
				</a>
				<div class="content w-[65%] md:w-full p-4 z-[1] relative">
				<?php 
				if(is_user_logged_in()){ 
					
						$count_key = 'wpb_post_views_count';
						$count = get_post_meta(get_the_ID(), $count_key, true);
					/* 	echo '<pre> View Count: ';
						var_dump(intval($count)); 
						echo '</pre>'; */
					
				} 
				
				?>
					<h5 class="text-xs uppercase font-g-medium font-normal mb-4">
                        <?php the_category( ' / ' ); ?>
					</h5>
					<h2 class="text-lg leading-[1.125rem] font-cg-medium font-medium -tracking-[.015rem] mb-4 sm:mb-10">
						<a href="<?php the_permalink(); ?>" class="text-primary hover:text-secondary block"><?php the_title(); ?></a>
					</h2>
					
				</div>
			</div>
            <?php $x++; endwhile; wp_reset_postdata(); ?>

		</div>
        <?php endif; ?>
	</div>
</section>