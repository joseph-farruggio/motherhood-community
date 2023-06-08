<article id="post-<?php the_ID(); ?>" <?php post_class( 'mb-12' ); ?>>

	<?php if( is_page() ): ?>
		<?php if( get_field('hide_page_title_gpo') != 1 ): ?>
		<header class="entry-header mb-4">
			<?php the_title( '<h1 class="entry-title font-cg-medium text-3xl md:text-6xl text-[#161616] mb-8">', '</h1>' ); ?>
		</header>
		<?php endif; ?>
	<?php else: ?>
		<header class="entry-header mb-4">
			<?php the_title( sprintf( '<h2 class="entry-title font-cg-medium text-3xl md:text-6xl text-[#161616] mb-8"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			<time datetime="<?php echo get_the_date( 'c' ); ?>" itemprop="datePublished" class="text-sm text-gray-700 hidden"><?php echo get_the_date(); ?></time>
		</header>
	<?php endif; ?>

	<?php if ( is_search() || is_archive() ) : ?>

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>

	<?php else : ?>

		<div class="entry-content">
			<?php
			/* translators: %s: Name of current post */
			the_content(
				sprintf(
					__( 'Continue reading %s', 'tailpress' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				)
			);

			wp_link_pages(
				array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'tailpress' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'tailpress' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				)
			);
			?>
		</div>

	<?php endif; ?>

</article>
