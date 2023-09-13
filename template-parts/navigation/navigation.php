<?php
$menu                      = build_nested_menu(wp_get_nav_menu_items('primary-menu'));
$top_level_menu_item_class = 'py-2 px-3 rounded-md text-base leading-6 text-gray-900 lg:text-[#413536] lg:hover:bg-[#B9AAAA]/25 transition-colors';
?>
<nav
    :class="{
        'flex flex-col fixed top-[65px] h-[calc(100vh-88px)] bg-white': $store.menuOpen, 
        'relative hidden lg:flex': !$store.menuOpen,
        'rounded-b-none': activeMenu !== null
    }"
    class="space-y-4 overflow-scroll [&>*:first-child]:mt-6 w-full max-w-7xl hidden px-2 lg:flex lg:space-y-0 lg:flex-row lg:flex-wrap lg:gap-x-4 lg:items-center lg:mx-auto lg:rounded-lg">

    <!-- Mobile Social Icons -->
    <div class="flex items-center justify-center gap-8 my-6 lg:hidden">
        <a href="https://www.instagram.com/motherhoodcommunityofficial/">
            <svg role="img" class="h-8 text-[#020202]/80 hover:text-[#020202]" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <title>Instagram</title>
                <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z" />
            </svg>
        </a>
        <a href="https://www.pinterest.com/motherhoodcommunity/">
            <svg role="img" class="h-8 text-[#020202]/80 hover:text-[#020202]" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <title>Pinterest</title>
                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.162-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.401.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.354-.629-2.758-1.379l-.749 2.848c-.269 1.045-1.004 2.352-1.498 3.146 1.123.345 2.306.535 3.55.535 6.607 0 11.985-5.365 11.985-11.987C23.97 5.39 18.592.026 11.985.026L12.017 0z" />
            </svg>
        </a>
        <a href="https://www.tiktok.com/@motherhoodcommunity">
            <svg role="img" class="h-8 text-[#020202]/80 hover:text-[#020202]" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <title>TikTok</title>
                <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
            </svg>
        </a>
        <a href="https://www.facebook.com/motherhoodcommunityofficial?mibextid=LQQJ4d">
            <svg role="img" class="h-8 text-[#020202]/80 hover:text-[#020202]" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <title>Facebook</title>
                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
            </svg>
        </a>
    </div>

    <?php
    // Loop the menu
    if ($menu):
        foreach ($menu as $item): ?>

            <!-- Menu Item with Children -->
            <?php if (isset($item->children)): ?>

                <!-- Parent Menu Item Button -->
                <button
                    @click='openMenu(<?= $item->ID ?>)'
                    type="button"
                    class="inline-flex items-center gap-x-1 <?= $top_level_menu_item_class; ?>"
                    :class="{'bg-[#B9AAAA]/25': activeMenu === <?= $item->ID ?>}"
                    aria-expanded="false">
                    <?= $item->title ?>
                    <svg
                        class="h-5 w-5 opacity-50"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        aria-hidden="true">
                        <path
                            fill-rule="evenodd"
                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                <!-- Child menu wrapper -->
                <div
                    x-show='activeMenu === <?= $item->ID ?>'
                    x-cloak
                    x-transition:enter='transition ease-out duration-200'
                    x-transition:enter-start='opacity-0 -translate-y-1'
                    x-transition:enter-end='opacity-100 translate-y-0'
                    x-transition:leave='transition ease-in duration-150'
                    x-transition:leave-start='opacity-100 translate-y-0'
                    x-transition:leave-end='opacity-0 -translate-y-1'
                    @click.away='activeMenu = null'
                    @keyup.escape.window="activeMenu = null"

                    class="!m-0 px-5 pt-2 w-full h-[calc(100vh-80px)] absolute left-0 pb-6 z-50 bg-white lg:border lg:border-[#B9AAAA]/25 rounded-lg shadow-lg lg:top-[70px] lg:w-full lg:pb-0 lg:px-8 lg:h-auto"
                    role='menu' aria-orientation='vertical' aria-labelledby='menu-button' tabindex='-1'>

                    <div class="top-[125px] overflow-auto flex flex-col justify-start mx-auto h-full w-full lg:max-w-[92rem]">
                        <button @click="activeMenu = null" class="bg-white gap-x-1 text-base leading-6 text-gray-900 pb-4 flex items-center gap-2 lg:hidden">
                            <span><?= $item->title; ?></span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M14.77 12.79a.75.75 0 01-1.06-.02L10 8.832 6.29 12.77a.75.75 0 11-1.08-1.04l4.25-4.5a.75.75 0 011.08 0l4.25 4.5a.75.75 0 01-.02 1.06z" clip-rule="evenodd" />
                            </svg>

                        </button>
                        <?php
                        $menu_layout = get_field('layout', $item->ID);
                        // $menu_layout options =  ['list', 'grid', 'wrap'];
                        ?>
                        <div class="overflow-auto flex-1 py-6 lg:pt-8 pb-4">
                            <?php get_template_part('template-parts/navigation/drop-down', $menu_layout, ['item' => $item]); ?>
                        </div>


                        <?php if (term_exists($item->title)): ?>
                            <div class="mt-auto h-[70px] relative">
                                <div class="h-12 bg-gradient-to-t from-white to-transparent absolute bottom-[70px] left-0 right-0 pointer-events-none lg:hidden"></div>
                                <div class="h-px w-full bg-[#413536]/5"></div>
                                <div class="pt-6">
                                    <a href="<?= $item->url; ?>" class="text-slate-700 hover:text-slate-900 flex items-center justify-center gap-2 group transition lg:justify-start lg:text-[#413536]">
                                        <span>View all in <?= $item->title; ?></span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="w-6 h-6 group-hover:translate-x-2 transition">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php else: ?>
                <!-- Single Menu Item -->
                <a
                    tabindex="0"
                    href='<?= $item->url; ?>'
                    data-menu-item-id="<?= esc_attr($item->ID); ?>"
                    class='<?= $top_level_menu_item_class; ?>' aria-current='page'>
                    <?= $item->title; ?>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>



    <div>
        <div class="my-8 w-full max-w-md mx-auto lg:hidden">
            <?php get_search_form(); ?>
        </div>
    </div>

</nav>