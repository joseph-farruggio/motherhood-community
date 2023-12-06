<?php get_header();

$term = get_queried_object();
$term_id = $term->term_id;

global $wp_query;

$tags = get_category_tags(['categories' => $term_id]);
?>

<div class="max-w-[78.125rem] mx-auto mt-14 mb-8 px-4">

    <div class="archive-header text-center mb-10">
        <div class="mb-6 inline-block border-b border-[#dadada] pb-[0.938rem]">
            <h1 class="archive-title font-cg-medium text-3xl md:text-6xl text-[#666666]">
                <?php if($_GET['hidden'] != ''): ?>
                    <?php if(get_field('category_icon', 'term_'.$term_id)): ?>
                        <img class="icon" src="<?php the_field('category_icon', "term_".$term_id); ?>" alt="<?php echo $term->name; ?> Icon"> 
                    <?php endif;?>
                <?php endif; ?>
                <?php echo $term->name; ?>
            </h1>
        </div>

        <?php if( category_description($term_id) ): ?>
            <div class="archive-description "><?php echo category_description($term_id); ?></div>
        <?php endif; ?>
    </div>

    <?php
    $top_articles = get_field('select_top_articles', 'term_'.$term_id);
    if( empty( $top_articles ) ) {
        $top_articles = new WP_Query([
            'post_type'         => 'post',
            'post_status'       => 'publish',
            'posts_per_page'    => 2,
            'fields'            => 'ids',
            'tax_query'         => [
                [
                    'taxonomy'  => $term->taxonomy,
                    'field'     => 'term_id',
                    'terms'     => $term_id
                ]
            ]
        ]);

        $top_articles = $top_articles->posts;
    }


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

            <?php if( !empty( $tags ) && $_GET['old-tag'] == 1 ): ?>
            <ul id="filterTags2" class="bg-white pl-4 flex relative z-[1] p-0 m-0 gap-2">
                <li data-tag_name="" class="text-xs cursor-pointer text-primary hover:text-secondary filter_tags active">All</li>
                <?php
                foreach($tags as $tag) {
                    echo '<span class="text-primary text-xs">/</span><li data-tag_name="'. $tag->tag_slug .'" class="text-xs cursor-pointer text-primary hover:text-secondary filter_tags">'. $tag->tag_name .'</li>';
                }
                ?>
            </ul>
            <?php endif; ?>
        </div>

        <?php if( !empty( $tags ) && $_GET['old-tag'] != 1 ): ?>
        <div class="tags mb-10">
            <ul id="filterTags" class="flex flex-wrap relative p-0 m-0 gap-2">
                <li data-tag_name="" class="bg-gray-600 py-3 px-5 rounded-sm text-sm cursor-pointer text-white hover:bg-secondary filter_tags active">All</li>
                <?php
                foreach($tags as $tag) {
                    echo '<li data-tag_name="'. $tag->tag_slug .'" class="bg-gray-600 py-3 px-5 rounded-sm text-sm cursor-pointer text-white hover:bg-secondary filter_tags">'. $tag->tag_name .'</li>';
                }
                ?>
            </ul>
        </div>
        <?php endif; ?>

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
                'tax_query'         => [
                    [
                        'taxonomy'  => $term->taxonomy,
                        'field'     => 'term_id',
                        'terms'     => $term_id
                    ]
                ]
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