<?php
$id      = 'custom-toc sidebar-toc-' . $block['id'];
$classes = 'sidebar-toc widget widget_block ';
if (!empty($block['className'])) {
    $classes .= $block['className'];
}
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">
    <h3 class="widgettitle flex items-center justify-between font-g-medium text-base text-[#353535] uppercase py-5 cursor-pointer tracking-[0.098rem]">
        <span><?php the_field('title_stocb'); ?></span>
        <?php icon_arrowd(); ?>
    </h3>

    <?php $shortcode = get_field('shortcode_stocb');
    if (!empty($shortcode)) {
        echo do_shortcode($shortcode);
    } ?>
</section>