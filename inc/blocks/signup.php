<?php 
$id = 'signup-' . $block['id'];
$classes = 'signup-block py-12 ';
if( !empty($block['className']) ) {
    $classes .= $block['className'];
}
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">
	<div class="max-w-7xl mx-auto">

        <div class="w-1/2 mx-auto px-4 text-center">
            <h3 class="text-black font-cg-medium text-[2.5rem] leading-[1.2em] mb-2"><?php the_field('heading_sib'); ?></h3>
            <p class="font-g-book text-lg font-light text-[#161616]"><?php the_field('subheading_sib'); ?></p>

            <?php $form = get_field('shortcode_sib'); if( $form ) {
                echo do_shortcode($form);
            } ?>

            <?php if( get_field('bottom_text_sib') ): ?>
            <div class="flex mt-12 justify-center gap-8">
                <p class="font-g-book text-sm uppercase tracking-widest font-bold"><?php the_field('bottom_text_sib'); ?></p>
                <a href="https://twitter.com/motherhoodcomm" target="_blank"><svg role="img" width="20" height="20" fill="#28bed7" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>Twitter</title><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg></a>
            </div>
            <?php endif; ?>
        </div>

	</div>
</section>