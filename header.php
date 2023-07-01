<!DOCTYPE html>
<html <?php language_attributes(); ?>>

    <head>
        <!-- Google Tag Manager -->
        <script>
            (function (w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    'gtm.start': new Date().getTime(),
                    event: 'gtm.js'
                });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s),
                    dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', 'GTM-KMQSG9');
        </script>
        <!-- End Google Tag Manager -->
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width">
        <meta name="fo-verify" content="366ada88-d6e1-4d81-a7e5-fb5731f06ecb">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

        <?php
        // get the post thumbnail url an preload it
        if (is_single()) {
            $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'image-845x0');
            if ($featured_img_url) {
                echo '<link rel="preload" as="image" href="' . $featured_img_url . '">';
            }
        }
        ?>
        <?php wp_head(); ?>
    </head>

    <body <?php body_class('bg-white text-gray-900 antialiased'); ?>>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KMQSG9"
                height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->

        <?php do_action('tailpress_site_before'); ?>

        <div id="page" class="min-h-screen flex flex-col">

            <?php do_action('tailpress_header'); ?>
            <?php $header_class = is_admin_bar_showing() ? '!sm:top-[46px]' : ''; ?>
            <header
                id="site-header"
                x-data="{activeMenu: null, openMenu(id) { this.activeMenu = this.activeMenu === id ? null : setTimeout(() => { this.activeMenu = id }, 0) } }"
                x-trap.noscroll="$store.menuOpen"
                class="sticky top-0 w-full bg-white/95 backdrop-blur-sm z-[10001] py-4 space-y-6 <?= $header_class; ?>">

                <div class="relative z-20 mx-auto max-w-7xl flex gap-x-8  flex-nowrap justify-between items-center px-5">
                    <!-- Logo / Left Outer Column -->
                    <div class="logo shrink-0 flex items-center gap-2">
                        <?php
                        $custom_logo_id = get_theme_mod('custom_logo');
                        $logo           = wp_get_attachment_image_src($custom_logo_id, 'full');
                        echo '<a href="' . esc_url(get_site_url()) . '" class="custom-logo-link"><img loading="not_lazy" src="' . esc_url($logo[0]) . '" width="' . $logo[1] . '" height="' . $logo[2] . '" alt="' . get_bloginfo('name') . '" class="custom-logo h-16 sm:max-h-[75px] w-auto"></a>';
                        ?>
                        <a href="/" class="sm:hidden">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/mobile-logo.jpg" alt="Motherhood Logo" class="h-16 w-auto">
                        </a>
                        <!-- <div class="h-10 w-10 lg:h-14 lg:w-14 bg-[#B9AAAA] rounded-full"></div>
                        <span class="font-g-medium text-base lg:text-xl text-[#413536]">Motherhood Community</span> -->
                    </div>

                    <!-- Right Outer Column -->
                    <div class="flex items-center gap-5">
                        <!-- Desktop Search -->
                        <div class="hidden lg:block w-full max-w-[15rem]">
                            <?php get_search_form(); ?>
                        </div>

                        <a href="/newsletter" class="hidden sm:inline bg-[#B9AAAA]/25 hover:bg-[#B9AAAA]/40 transition-colors text-[#413536] px-4 py-2 rounded-md">Subscribe</a>

                        <!-- Mobile Menu Toggle -->
                        <button @click="$store.menuOpen = !$store.menuOpen; activeMenu=null" class="lg:hidden">
                            <svg x-show="!$store.menuOpen" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                                <path fill-rule="evenodd" d="M3 9a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 9zm0 6.75a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75a.75.75 0 01-.75-.75z" clip-rule="evenodd" />
                            </svg>
                            <svg x-show="$store.menuOpen" x-cloak xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                                <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>


                </div>

                <?php get_template_part('template-parts/navigation/navigation'); ?>
            </header>

            <div id="content" class="site-content flex-grow mt-0 lg:mt-12">

                <?php do_action('tailpress_content_start'); ?>

                <main>