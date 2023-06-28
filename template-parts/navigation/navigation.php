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
    class="space-y-4 w-full max-w-7xl hidden px-2 lg:flex lg:space-y-0 lg:flex-row lg:flex-wrap lg:gap-x-4 lg:items-center lg:mx-auto lg:rounded-lg">
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
        <div class="mt-16 w-full max-w-md mx-auto lg:hidden">
            <?php get_search_form(); ?>
        </div>
    </div>
</nav>