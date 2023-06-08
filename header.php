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
                class="sticky top-0 mx-auto w-full bg-white z-[9999999] max-w-7xl px-5 py-4 <?= $header_class; ?>">
                <div class="relative z-20 mx-auto max-w-7xl bg-white flex gap-x-8  flex-nowrap justify-between items-center lg:py-6">

                    <div class="logo shrink-0">
                        <?php
                        $custom_logo_id = get_theme_mod('custom_logo');
                        $logo           = wp_get_attachment_image_src($custom_logo_id, 'full');
                        echo '<a href="' . esc_url(get_site_url()) . '" class="custom-logo-link shrink-0 m-0"><img loading="not_lazy" src="' . esc_url($logo[0]) . '" width="' . $logo[1] . '" height="' . $logo[2] . '" alt="' . get_bloginfo('name') . '" class="custom-logo h-16 sm:max-h-[75px] w-auto"></a>';
                        ?>
                    </div>

                    <!-- Mobile Menu Toggle -->
                    <button @click="$store.menuOpen = !$store.menuOpen; activeMenu=null" class="lg:hidden">
                        <svg x-show="!$store.menuOpen" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                            <path fill-rule="evenodd" d="M3 9a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 9zm0 6.75a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75a.75.75 0 01-.75-.75z" clip-rule="evenodd" />
                        </svg>
                        <svg x-show="$store.menuOpen" x-cloak xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                            <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div class="hidden relative lg:flex w-full items-center justify-end gap-8 h-[48px]">
                        <!-- Desktop Secondary Nav -->
                        <div class="flex gap-8" x-show="!$store.searchOpen">
                            <?php
                            $secondary_nav = build_nested_menu(wp_get_nav_menu_items('secondary-menu'));

                            if ($secondary_nav) {
                                foreach ($secondary_nav as $item) {
                                    echo '<a href="' . $item->url . '" class="text-base font-semibold leading-6 text-gray-900 hover:text-gray-700">' . $item->title . '</a>';
                                }
                            }
                            ?>
                        </div>

                        <!-- Desktop Search -->
                        <div
                            x-show="$store.searchOpen"
                            x-cloak
                            x-transition:enter='transition ease-out duration-200'
                            x-transition:enter-start='opacity-0 -translate-y-1'
                            x-transition:enter-end='opacity-100 translate-y-0'
                            x-transition:leave='transition ease-in duration-150'
                            x-transition:leave-start='opacity-100 translate-y-0'
                            x-transition:leave-end='opacity-0 -translate-y-1'
                            class="w-96 flex justify-end absolute top-0 right-12">
                            <?php get_search_form(); ?>
                        </div>

                        <!-- Desktop Search Toggle  -->
                        <button @click="$store.searchOpen = !$store.searchOpen" class="hidden lg:block">
                            <svg x-show="!$store.searchOpen" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 012.25 10.5z" clip-rule="evenodd" />
                            </svg>

                            <svg x-show="$store.searchOpen" x-cloak xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
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