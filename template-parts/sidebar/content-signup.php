<div class="sidebar-signup">

<?php if( have_rows('signup_form_mcoptions', 'option') ):
    while( have_rows('signup_form_mcoptions', 'option') ) : the_row(); ?>

    <?php if( have_rows('section_heading') ):
        while( have_rows('section_heading') ) : the_row(); ?>
        <h3 class="sec-heading text-sm xlg:text-xs font-bold font-g-book uppercase tracking-widest <?php echo get_sub_field('align') == 'center' ? 'text-center ' : 'text-left '; ?>mb-10 relative after:content-none xlg:after:content-[''] after:w-full after:h-px after:bg-[#979797]/[.3] after:absolute after:left-0 after:top-2/4">
            <span class="<?php echo get_sub_field('align') == 'center' ? 'px-4 ' : 'pr-4 '; ?> inline-block bg-white relative z-[1]"><?php _e(get_sub_field('heading'), 'mhc22'); ?></span>
        </h3>
        <?php endwhile;
    endif; ?>

    <div class="signup mb-12">
        <div class="border border-black p-6">
			<?php echo do_shortcode('[gravityform id="10" title="false" description="false"]'); ?>
			
<div class="ml-embedded remove-it" data-form="eRTC9i"></div>			
            <?php //the_sub_field('shortcode'); ?>
        </div>
    </div>
    <?php
    endwhile;
endif; ?>

</div>