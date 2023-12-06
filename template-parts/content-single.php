<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="entry-header mb-4">
        <h5 class="text-sm uppercase font-g-medium font-normal mb-2.5 text-slate-600 tracking-widest">
            <?php the_category(' / '); ?>
        </h5>
        <?php the_title('<h1 class="entry-title font-cg-medium text-4xl md:text-6xl text-[#161616] mt-2 mb-4">', '</h1>'); ?>
        <div class="meta flex flex-col md:flex-row items-start md:items-center justify-between gap-3 md:gap-0 mb-9">
            <div class="flex items-center gap-2">
                <span class="text-sm uppercase font-medium text-slate-600"><?php _e('Updated on ') ?><time><?php echo get_the_modified_date(); ?></time></span>
                <div class="h-1 w-1 bg-slate-500 rounded-full"></div>
                
            </div>
            <?php if (!is_singular('podcasts')): ?>
                <?php $urlToShare = urlencode(get_the_permalink()); ?>
                <div class="hidden lg:flex items-center gap-3" x-data="social()">
                    <span class="text-sm uppercase font-medium text-slate-600">Share:</span>
                    <button @click="share('https://www.facebook.com/sharer.php?u=<?= $urlToShare; ?>')">
                        <svg role="img" class="h-8 text-[#020202]/80 hover:text-[#020202]" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <title>Facebook</title>
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                    </button>

                    <button @click="share('https://twitter.com/intent/tweet?url=<?= $urlToShare; ?>')">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="h-8 text-[#020202]/80 hover:text-[#020202]" fill="currentColor">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15 0C6.71573 0 0 6.7157 0 15s6.71573 15 15 15c8.2843 0 15-6.7157 15-15S23.2843 0 15 0Zm8.446 6-6.3287 7.6218L24 24h-5.0621l-4.6351-6.9886L8.49976 24H7l6.637-7.9926L7 6h5.0621l4.389 6.6179L21.9463 6h1.4997Zm-9.0553 9.099.6725.9966 4.5802 6.7879h2.3036l-5.6129-8.3181-.6724-.9964-4.318-6.39932H9.04016L14.3907 15.099Z" />
                        </svg>
                    </button>

                    <button @click="share('http://pinterest.com/pin/create/bookmarklet/?url=<?= $urlToShare; ?>&is_video=false&media=<?= get_the_post_thumbnail_url(); ?>')">
                        <svg role="img" class="h-8 text-[#020202]/80 hover:text-[#020202]" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <title>Pinterest</title>
                            <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.162-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.401.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.354-.629-2.758-1.379l-.749 2.848c-.269 1.045-1.004 2.352-1.498 3.146 1.123.345 2.306.535 3.55.535 6.607 0 11.985-5.365 11.985-11.987C23.97 5.39 18.592.026 11.985.026L12.017 0z" />
                        </svg>
                    </button>


                    <button @click="$clipboard('<?= get_the_permalink(); ?>'), active = true, setTimeout(() => { active = false}, 2000)" class="relative" x-data="{active: false}">
                        <svg class="h-8 text-[#020202]/80 hover:text-[#020202]" fill="currentColor" viewBox="0 0 30 31" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.756 30.972C6.606 30.972 0 24.039 0 15.486S6.607 0 14.756 0c8.15 0 14.757 6.933 14.757 15.486s-6.607 15.486-14.757 15.486zm-1.5-17.631l3.052-3.053a2.347 2.347 0 0 1 3.32 0l.099.1a2.347 2.347 0 0 1 0 3.319l-3.052 3.052 1.328 1.328 3.052-3.052a4.225 4.225 0 0 0 0-5.976l-.099-.099a4.225 4.225 0 0 0-5.976 0l-3.052 3.053 1.328 1.328zm-1.421 1.42l-1.328-1.327-2.342 2.342a4.225 4.225 0 0 0 0 5.975l.099.1a4.225 4.225 0 0 0 5.976 0l2.341-2.342-1.328-1.328-2.341 2.341a2.347 2.347 0 0 1-3.32 0l-.1-.099a2.347 2.347 0 0 1 0-3.32l2.343-2.341zm5.298-3.228l-6.751 6.75 1.35 1.35 6.75-6.75-1.35-1.35z" fill-rule="nonzero" />
                        </svg>
                        <div class="absolute top-0 left-0 -ml-4 mt-10 bg-slate-900 text-slate-50 px-2 py-1 rounded-lg hidden" :class="{'hidden': !active}">Copied!</div>
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </header>

    <?php
    if (has_post_thumbnail()) {
        the_post_thumbnail('image-845x0', ['class' => 'featured-image mb-6 !max-w-full']);
    }
    ?>
    <div
        x-data="navigatorShare(
            '<?= esc_attr(addslashes(get_the_title())); ?>', 
            '<?= esc_attr(addslashes(get_the_excerpt())); ?>',
            '<?= esc_url(get_the_permalink()); ?>')"
        class="lg:hidden">
        <button
            @click="shareThis()"
            class="mx-auto flex items-center gap-4 bg-transparent border-none p-1 hover:cursor-pointer">
            <span>Share this article</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 fill-transparent">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
            </svg>
        </button>
    </div>
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