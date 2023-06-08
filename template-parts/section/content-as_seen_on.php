<?php if( have_rows('logos_asolmcoptions', 'option') ): ?>
<section id="partners-logo" class="partners-logo splide pt-8 pb-14 bg-light" aria-label="Partners Logo">
	<div class="max-w-7xl px-5 mx-auto">

        <?php if( get_field('heading_asolmcoptions', 'option') ): ?>
        <h3 class="sec-heading text-xs font-bold font-g-book uppercase tracking-widest text-center mb-10 relative after:content-[''] after:w-full after:h-px after:bg-[#979797]/[.3] after:absolute after:left-0 after:top-2/4">
            <span class="bg-light px-4 inline-block relative z-[1]"><?php the_field('heading_asolmcoptions', 'option'); ?></span>
        </h3>
        <?php endif; ?>
        
		<div class="splide__track">
			<ul class="splide__list items-center">

                <?php while( have_rows('logos_asolmcoptions', 'option') ) : the_row(); ?>
				<li class="splide__slide">
                    <?php echo wp_get_attachment_image( get_sub_field('add_image'), 'full', "", array( "class" => "mx-auto" ) ); ?>
				</li>
                <?php endwhile; ?>

			</ul>
		</div>

	</div>
</section>
<?php endif; ?>