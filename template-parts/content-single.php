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
                <span class="text-sm uppercase font-medium text-slate-600"><?php echo do_shortcode('[rt_reading_time label="" postfix="minute read"]'); ?></span>
            </div>
            <?php if (!is_singular('podcasts')): ?>
                <?php $urlToShare = urlencode(get_the_permalink()); ?>
                <div class=" hidden lg:flex items-center gap-3" x-data="social()">
                    <button @click="share('https://www.facebook.com/sharer.php?u=<?= $urlToShare; ?>')">
                        <svg width="30" height="31" viewBox="0 0 30 31" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.731 24.01v-8.787h-1.76V12.31h1.76V10.55c0-2.376.7-4.09 3.263-4.09h3.049v2.908h-2.147c-1.075 0-1.32.725-1.32 1.484v1.46h3.308l-.451 2.912h-2.857v8.787H12.73zM15 30.447c8.284 0 15-6.816 15-15.223C30 6.816 23.284 0 15 0 6.715 0 0 6.816 0 15.224c0 8.407 6.715 15.223 15 15.223z" fill="#1A2E3B" fill-rule="evenodd" />
                        </svg>
                    </button>

                    <button @click="share('https://twitter.com/intent/tweet?url=<?= $urlToShare; ?>')">
                        <svg width="30" height="31" viewBox="0 0 30 31" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.913 30.352C6.677 30.352 0 23.575 0 15.217 0 6.857 6.677.082 14.913.082c8.235 0 14.912 6.776 14.912 15.135 0 8.358-6.677 15.135-14.912 15.135m2.071-21.047c-1.302.482-2.125 1.721-2.03 3.079l.03.523-.52-.064c-1.896-.245-3.552-1.08-4.959-2.48l-.687-.694-.177.513c-.375 1.144-.135 2.351.645 3.164.417.448.323.513-.395.245-.25-.085-.469-.15-.49-.117-.072.075.177 1.047.375 1.432.27.535.823 1.058 1.427 1.368l.511.246-.604.01c-.583 0-.604.011-.541.236.208.695 1.03 1.433 1.947 1.753l.645.224-.561.342a5.774 5.774 0 0 1-2.792.791c-.469.01-.854.053-.854.085 0 .107 1.27.706 2.01.94 2.218.696 4.854.396 6.833-.79 1.406-.845 2.812-2.523 3.468-4.147.355-.866.709-2.448.709-3.206 0-.492.031-.556.614-1.144.344-.342.667-.716.729-.822.105-.204.094-.204-.437-.022-.885.32-1.01.278-.573-.203.323-.342.708-.962.708-1.144 0-.032-.156.021-.333.118-.187.106-.604.267-.917.363l-.562.182-.51-.353c-.282-.192-.677-.406-.886-.47-.53-.15-1.344-.129-1.823.042" fill="#1A2E3B" fill-rule="evenodd" />
                        </svg>
                    </button>

                    <button @click="share('https://www.linkedin.com/shareArticle?mini=true&url=<?= $urlToShare; ?>')">
                        <svg width="30" height="30" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 30C6.716 30 0 23.284 0 15 0 6.716 6.716 0 15 0c8.284 0 15 6.716 15 15 0 8.284-6.716 15-15 15zm-3.642-8V11.985h-3.11V22h3.11zM9.8 10.62c.994 0 1.8-.824 1.8-1.819a1.802 1.802 0 0 0-3.601 0c0 .995.807 1.818 1.8 1.818zM22.997 22H23v-5.501c0-2.692-.58-4.765-3.726-4.765-1.513 0-2.527.83-2.942 1.618h-.044v-1.367h-2.982V22h3.106v-4.959c0-1.306.248-2.568 1.865-2.568 1.593 0 1.617 1.49 1.617 2.652V22h3.103z" fill="#1A2E3B" fill-rule="nonzero" />
                        </svg>
                    </button>


                    <button @click="$clipboard('<?= get_the_permalink(); ?>'), active = true, setTimeout(() => { active = false}, 2000)" class="relative" x-data="{active: false}">
                        <svg width=" 30" height="31" viewBox="0 0 30 31" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.756 30.972C6.606 30.972 0 24.039 0 15.486S6.607 0 14.756 0c8.15 0 14.757 6.933 14.757 15.486s-6.607 15.486-14.757 15.486zm-1.5-17.631l3.052-3.053a2.347 2.347 0 0 1 3.32 0l.099.1a2.347 2.347 0 0 1 0 3.319l-3.052 3.052 1.328 1.328 3.052-3.052a4.225 4.225 0 0 0 0-5.976l-.099-.099a4.225 4.225 0 0 0-5.976 0l-3.052 3.053 1.328 1.328zm-1.421 1.42l-1.328-1.327-2.342 2.342a4.225 4.225 0 0 0 0 5.975l.099.1a4.225 4.225 0 0 0 5.976 0l2.341-2.342-1.328-1.328-2.341 2.341a2.347 2.347 0 0 1-3.32 0l-.1-.099a2.347 2.347 0 0 1 0-3.32l2.343-2.341zm5.298-3.228l-6.751 6.75 1.35 1.35 6.75-6.75-1.35-1.35z" fill="#1A2E3B" fill-rule="nonzero" />
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