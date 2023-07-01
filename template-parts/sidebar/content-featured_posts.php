<?php
$post_id = get_queried_object_id();
$cat_id  = get_the_category($post_id);
$cat_id  = $cat_id[0]->cat_ID;
?>

<section id="sidebar-featured-post" class="sidebar-featured-post splide" aria-label="Featured Posts">

    <h3 class="flex items-center justify-between font-g-medium text-base text-[#353535] uppercase py-5 tracking-[0.098rem]">
        <span><?php _e('Featured Posts', 'mhc22'); ?></span>
    </h3>

    <?php
    $posts = [];
    if (get_field('featured_post')) {
        $row = get_field('featured_post', $post_id);

        foreach ($row as $single) {
            $posts[] = $single['post'];
        }

    } elseif (get_field('featured_posts_cat', 'term_' . $cat_id)) {
        $row = get_field('featured_posts_cat', 'term_' . $cat_id);

        foreach ($row as $single) {
            $posts[] = $single['post_cat'];
        }

    } elseif (get_field('featured_post_global', 'options')) {
        $row = get_field('featured_post_global', 'options');

        foreach ($row as $single) {
            $posts[] = $single['post_global'];
        }

    }
    ?>

    <?php
    if (!empty($posts)):
        // Build the JS array
        $featured_arr = [];
        $i            = 0;
        foreach ($posts as $single_post) {
            $featured_arr[$i] = [
                'title'      => $single_post->post_title,
                'permalink'  => get_permalink($single_post->ID),
                'image_html' => get_the_post_thumbnail($single_post->ID, 'image-384x256'),
                'excerpt'    => wp_trim_words(strip_shortcodes($single_post->post_content), 20, '...')
            ];
            $i++;
        }
        wp_reset_postdata();
    endif; ?>

    <ul x-data='featuredPosts(<?= json_encode($featured_arr, JSON_HEX_APOS | JSON_HEX_QUOT); ?>)'>
        <template x-if="posts">
            <template x-for="(post, index) in posts">
                <li x-show="active == index">
                    <a :href="post.permalink" class="block" x-html="post.image_html"></a>

                    <div class="content pt-4">
                        <h2 class="text-[2rem] leading-[2rem] font-cg-medium font-medium -tracking-[.43px] mb-4">
                            <a :href="post.permalink" x-text="post.title" class="text-primary hover:text-secondary block"></a>
                        </h2>
                        <p x-text="post.excerpt" class="text-lg font-g-light text-[#353535]"></p>
                        <a :href="post.permalink" class="read-more text-xs text-secondary uppercase">Read more</a>
                    </div>
                </li>
            </template>
        </template>
        <template x-if="posts.length > 1">
            <div class="flex items-center justify-center md:justify-start gap-4 mt-4">
                <button class="p-4 bg-[#B9AAAA]/25 hover:bg-[#B9AAAA]/40 transition-colors text-[#413536] px-4 py-2 rounded-md" @click="prev()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                    </svg>

                </button>
                <button class="p-4 bg-[#B9AAAA]/25 hover:bg-[#B9AAAA]/40 transition-colors text-[#413536] px-4 py-2 rounded-md" @click="next()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                    </svg>

                </button>
            </div>
        </template>
    </ul>

</section>