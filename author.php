<?php get_header();

global $wp_query;
$curauth = $wp_query->get_queried_object();

?>

<div class="max-w-[78.125rem] mx-auto mt-14 mb-8 px-4">

    <div class="archive-header text-center mb-10">
        <div class="mb-6 inline-block border-b border-[#dadada] pb-[0.938rem]">
            <h1 class="archive-title font-cg-medium text-3xl md:text-6xl text-[#666666]">
				<img class="avatar avatar-100 photo rounded-full mx-auto mb-4" data-pin-nopin="nopin" src="<?php echo esc_url(get_avatar_url($curauth->ID, array('size' => 200))); ?>" alt="<?php echo $curauth->nickname; ?>'s photo" /> 
                <?php echo $curauth->nickname; ?>
            </h1>
        </div>

        <?php if( $curauth->description ): ?>
            <div class="author-bio">
				<p><?php echo str_replace("\n", "<br />", $curauth->description); ?></p>
			</div>
        <?php endif; ?>
    </div>


    <?php
	$top_articles = new WP_Query([
		'post_type'         => 'post',
		'post_status'       => 'publish',
		'posts_per_page'    => 2,
		'author'			=> $curauth->ID
	]);

	$top_articles = $top_articles->posts;

	$top_articles_IDs = [];

    if( !empty( $top_articles ) ): ?>
    <section class="top-articles-section">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <?php foreach($top_articles as $post): 
                setup_postdata($post);
				$top_articles_IDs[] = $post->ID ?>
            <div class="group">
                <div class="image border-[3px] border-solid border-transparent group-hover:border-black relative">
                    <a href="<?php the_permalink(); ?>" class="block overflow-hidden  after:content-[''] after:w-full after:h-0 after:bg-white/[.75] after:absolute after:left-0 after:top-0">
                        <?php the_post_thumbnail('image-595x398', ['class' => 'w-full transition ease-linear group-hover:scale-125']); ?>
                    </a>
                </div>
                <div class="content relative bg-white mx-[8%] -mt-[65px] px-5 md:px-11 py-6 md:py-12 text-center">
                    <h5 class="text-sm uppercase font-g-medium font-normal mb-4">
                        <?php the_category( ' / ' ); ?>
                    </h5>
                    <h2 class="text-2xl md:text-[2rem] md:leading-[2rem] font-cg-medium font-medium  -tracking-[1.85px] mb-4">
                        <a href="<?php the_permalink(); ?>" class="text-primary hover:text-secondary block"><?php the_title(); ?></a>
                    </h2>
                    <p class="text-sm font-g-light text-[#353535] mb-4"><?php echo wp_trim_words( strip_shortcodes( get_the_content() ), 20, '...' );?></p>
                    
                </div>
            </div>
            <?php endforeach; wp_reset_postdata(); ?>
        </div>
    </section>
    <?php endif; ?>

    <section class="stories-section">

        <div class="flex justify-between relative mb-10 after:content-[''] after:w-full after:h-px after:bg-[#979797]/[.3] after:absolute after:left-0 after:top-2/4">
            <h3 class="sec-heading text-xs font-bold font-g-book uppercase tracking-widest bg-white pr-4 relative z-[1]"><?php _e('more stories', 'mhc22') ?></h3>
        </div>

        <?php
        if( $wp_query->post_count <= 1 ) {
            get_template_part( 'template-parts/content', 'none' );
        } else {
            $args = [
                'posts_per_page'    => -1,
                'meta_key'          => 'wpb_post_views_count',
                'orderby'           => 'meta_value_num',
                'order'             => 'DESC',
                'post__not_in'		=> $top_articles_IDs,
                'author'			=> $curauth->ID
            ];
            query_posts($args);

            echo '<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-8">';
            while( have_posts() ) : the_post();
            $terms = get_the_terms(get_the_ID(), 'post_tag');
            $terms = join(' ', wp_list_pluck($terms, 'slug'));
            ?>
            <div class="tags_posts text-left <?php echo $terms; ?>">
				<a href="<?php the_permalink(); ?>" class="block relative">
                    <?php the_post_thumbnail( 'image-284x180' ); ?>
				</a>
				<div class="content py-4 relative">
					<h5 class="text-sm tracking-[.084rem] uppercase font-g-medium font-normal mb-4">
                        <?php the_category( ' / ' ); ?>
					</h5>
					<h2 class="text-lg md:text-[2rem] md:leading-[2.25rem] font-cg-medium font-medium -tracking-[.015rem] mb-10">
						<a href="<?php the_permalink(); ?>" class="text-primary hover:text-secondary block"><?php the_title(); ?></a>
					</h2>
                    <p class="text-sm font-g-light text-[#353535] mb-4"><?php echo wp_trim_words( strip_shortcodes( get_the_content() ), 20, '...' );?></p>
				</div>
			</div>
            <?php
            endwhile;
            wp_reset_postdata();
            echo '</div>';
        }
        ?>
    </section>

</div>

<?php
get_template_part('template-parts/section/content', 'editors_pick');
get_template_part('template-parts/section/content', 'as_seen_on');

get_footer();