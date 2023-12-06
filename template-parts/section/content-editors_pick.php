<?php 
$editors_posts = get_field('moreeditorspick_fsmcoptions', 'option');

$editors_title = $editors_posts['heading'];
$editors_posts = $editors_posts['select_articles'];

if( !empty( $editors_posts ) ): ?>
<section class="grid5-posts pt-[1.875rem] pb-[3.438rem] bg-light">
	<div class="max-w-7xl px-5 mx-auto">

        <h3 class="sec-heading text-sm md:text-xs font-bold font-g-book uppercase tracking-[2px] md:tracking-widest md:text-center mt-[15px] md:mt-0 py-[30px] md:py-0 md:mb-10 relative after:content-none md:after:content-[''] after:w-full after:h-px after:bg-[#979797]/[.3] after:absolute after:left-0 after:top-2/4">
            <span class="bg-light md:px-4 inline-block relative z-[1] text-[#353535]"><?php _e($editors_title, 'mhc22'); ?></span>
        </h3>

		<div class="related-posts grid grid-cols-1 md:grid-cols-5 gap-y-4 md:gap-y-0 gap-x-4">

            <?php $x = 1; foreach($editors_posts as $post): 
				setup_postdata($post); ?>
			<div class="card bg-white flex flex-row md:flex-col space-x-3 md:space-x-0 text-left md:text-center">
				<a href="<?php the_permalink(); ?>" class="block w-[45%] md:w-full relative h-full md:h-auto">
                    <?php the_post_thumbnail( 'image-235x155' ); ?>
					<span class="inline-block w-[50px] md:w-[70px] h-[50px] md:h-[70px] top-1/2 md:top-auto -translate-y-1/2 md:-translate-y-auto bg-white font-cg-medium text-[2rem] text-[#161616] text-center rounded-full absolute md:left-2/4 md:-bottom-[60px] md:-ml-[35px] right-[-20px] md:right-auto"><?php echo $x; ?></span>
				</a>
				<div class="content w-[65%] md:w-full p-4 z-[1] relative">
					<h5 class="text-xs uppercase font-g-medium font-normal mb-4">
                        <?php the_category( ' / ' ); ?>
					</h5>
					<h2 class="text-lg leading-[1.125rem] font-cg-medium font-medium -tracking-[.015rem] mb-10">
						<a href="<?php the_permalink(); ?>" class="text-primary hover:text-secondary block"><?php the_title(); ?></a>
					</h2>
					
				</div>
			</div>
            <?php $x++; endforeach; wp_reset_postdata(); ?>

		</div>
	</div>
</section>
<?php endif; ?>