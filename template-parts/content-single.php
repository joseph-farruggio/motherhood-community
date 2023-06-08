<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="entry-header mb-4">
        <h5 class="text-sm uppercase font-g-medium font-normal mb-2.5 tracking-widest">
            <?php the_category(' / '); ?>
        </h5>
        <?php the_title('<h1 class="entry-title font-cg-medium text-3xl md:text-6xl text-[#161616] mb-4">', '</h1>'); ?>
        <div class="meta flex flex-col md:flex-row items-start md:items-center justify-between gap-3 md:gap-0 mb-9">
            <div>
                <span class="uppercase text-xs text-[#1e353d]/[.37] block"><?php _e('Updated on ') ?><time><?php echo get_the_modified_date(); ?></time></span>
                <span class="uppercase text-xs text-[#1e353d]/[.37] block"><?php echo do_shortcode('[rt_reading_time label="" postfix="minute read"]'); ?></span>
            </div>
            <?php if (!is_singular('podcasts')): ?>
            <div class="meta-share">
                <?php echo do_shortcode('[addtoany]'); ?>
            </div>
            <?php endif; ?>
        </div>
    </header>

    <?php
	if (has_post_thumbnail()) {
		the_post_thumbnail('image-845x0', ['class' => 'featured-image mb-10 !max-w-full']);
	}
	?>

    <div class="entry-content">
        <?php
		the_content();

		if (is_singular('podcasts')) {
			get_template_part('template-parts/content', 'podcast');
		}
		?>

        <?php
		wp_link_pages(
			array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'tailpress') . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __('Page', 'tailpress') . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			)
		);
		?>
    </div>

</article>