<?php if( have_rows('signupform_fmcoptions', 'option') ): ?>
    <?php while( have_rows('signupform_fmcoptions', 'option') ) : the_row(); ?>
    <section class="signup-block py-12 border-t">
        <div class="max-w-7xl mx-auto">

            <div class="w-full sm:w-5/6 md:w-1/2 mx-auto px-4 text-center">
				<div style="display:none">
                <?php //if(get_sub_field('heading')): ?>
                    <h3 class="text-black font-cg-medium text-[1.875rem] md:text-[2.5rem] leading-[1.2rem] mb-2"><?php //the_sub_field('heading'); ?></h3>
                <?php //endif; ?>
                <?php //if(get_sub_field('subheading')): ?>
                    <p class="font-g-book text-base md:text-lg font-light text-[#161616]"><?php //the_sub_field('subheading'); ?></p>
                <?php //endif; ?>
				<?php // $form = get_sub_field('shortcode'); if( $form ) {
                   // echo do_shortcode($form);  }
                 ?>
				 </div>

				<div class="ml-embedded" data-form="eRTC9i"></div>
				
				
				       
                <?php if( get_sub_field('bottom_text') ): ?>
                <div class="flex mt-12 justify-center gap-8">
                    <p class="font-g-book text-sm uppercase tracking-widest font-bold"><?php the_sub_field('bottom_text'); ?></p>
                    <?php if( get_sub_field('twitter_link') ): ?>
                        <a href="<?php esc_url(the_sub_field('twitter_link')); ?>" target="_blank"><svg role="img" width="20" height="20" fill="#28bed7" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>Twitter</title><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg></a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>

        </div>
    </section>
    <?php endwhile; ?>
<?php endif; ?>