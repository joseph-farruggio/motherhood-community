<?php
$menu = build_nested_menu(wp_get_nav_menu_items('primary-menu'));
?>
<nav
    :class="$store.menuOpen && 'block divide-y divide-theme-900/50' || 'hidden lg:block'"
    class="w-full py-6 flex flex-col bg-theme-800 lg:w-auto lg:flex-row lg:flex-wrap lg:py-0">

    <?php
    // Loop the menu
    if ($menu):
        foreach ($menu as $item): ?>

            <!-- Menu Item with Children -->
            <?php if (isset($item->children)): ?>
                <div x-data="{open: false}" class='relative inline-block text-left'>
                    <!-- Parent Menu Item Button -->
                    <div>
                        <button type='button'
                            data-menu-item-id="<?= esc_attr($item->ID); ?>"
                            @click='open = !open'
                            :class="open && 'bg-theme-900 lg:bg-transparent'"
                            class='text-theme-100 text-base inline-flex items-center w-full p-2 rounded-md font-medium border-none transition-colors hover:bg-theme-900/50 group'
                            id='menu-button' aria-expanded='true' aria-haspopup='true'>
                            <?= $item->title ?>

                            <svg :class="open && 'transform rotate-180'" class='h-6 w-6 opacity-50 transition-opacity group-hover:opacity-100' xmlns='http://www.w3.org/2000/svg'
                                viewBox='0 0 20 20' fill='currentColor' aria-hidden='true'>
                                <path fill-rule='evenodd'
                                    d='M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z'
                                    clip-rule='evenodd' />
                            </svg>
                        </button>
                    </div>

                    <!-- Child menu wrapper -->
                    <?php
                    $columnCount         = get_field('column_count', $item->ID);
                    $submenuWrapperClass = (get_field('has_columns', $item->ID)) ? "menu-has-columns menu-columns-$columnCount" : "";
                    ?>
                    <div
                        x-show='open'
                        x-cloak
                        @click.away='open = false'
                        @keyup.escape.window="open = false"
                        class='submenu-wrapper mt-2 focus:outline-none px-4 py-1
                            lg:px-6 lg:py-6 lg:absolute lg:left-0 lg:transform 
                            lg:z-10 lg:min-w-[200px] lg:rounded-md lg:bg-white lg:shadow-lg lg:ring-1 lg:ring-black lg:ring-opacity-5
                            <?= $submenuWrapperClass; ?>'
                        role='menu' aria-orientation='vertical' aria-labelledby='menu-button' tabindex='-1'>

                        <!-- Caret -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="w-5 h-5 text-white hidden lg:block  lg:absolute lg:left-1/2 lg:transform lg:-translate-x-1/2 -mt-9">
                            <g data-name="Group 341">
                                <path data-name="Path 563" d="M8.114 3.876a2.47 2.47 0 0 1 3.772 0l7.819 10.875c.838 1.167-.212 2.625-1.887 2.625H2.181c-1.677 0-2.725-1.458-1.886-2.625Z" fill="#fff" fill-rule="evenodd" />
                                <path data-name="Rectangle 368" fill="none" d="M0 0h20v20H0z" />
                            </g>
                        </svg>

                        <div class="column-wrapper">
                            <!-- Loop child items -->
                            <?php foreach ($item->children as $child): ?>
                                <?php $parent_class = isset($child->children) ? 'font-bold border-b' : ''; ?>
                                <div>
                                    <a
                                        tabindex="0"
                                        href='<?= $child->url ?>'
                                        data-menu-item-id="<?= esc_attr($child->ID); ?>"
                                        class='<?= $parent_class; ?> text-sm font-medium leading-6 text-gray-500'
                                        role='menuitem' tabindex='-1' id='menu-item-0'><?= $child->title; ?></a>

                                    <?php if (isset($child->children)): ?>
                                        <!-- Grandchild items -->
                                        <div class="flex flex-col gap-2 flex-nowrap">
                                            <?php foreach ($child->children as $grandchild): ?>                         <?php $parent_class = get_field('is_sub_parent', $child->ID) ? 'font-bold border-b' : ''; ?>
                                                <?php $cta_class = get_field('is_cta', $grandchild->ID) ? 'font-bold mt-4' : ''; ?>
                                                <a
                                                    tabindex="0"
                                                    href='<?= $grandchild->url ?>'
                                                    data-menu-item-id="<?= esc_attr($grandchild->ID); ?>"
                                                    class='<?= $cta_class; ?> w-full block px-0 py-2 text-lg rounded-md text-theme-50 font-medium lg:text-theme-700 lg:hover:text-theme-900 lg:py-2 lg:text-sm'
                                                    role='menuitem' tabindex='-1' id='menu-item-0'><?= $grandchild->title; ?></a>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>

                        </div>

                        <?php if (get_field('menu_cta', $item->ID)):
                            $menu_cta = get_field('menu_cta', $item->ID); ?>
                            <div class="lg:mt-4 lg:pt-4 lg:border-t lg:border-slate-100">
                                <a
                                    tabindex="0"
                                    href="<?= esc_url($menu_cta['url']); ?>"
                                    class="whitespace-nowrap flex gap-4 items-center justify-center text-lg font-medium text-theme-50 mt-2 px-4 py-2 w-full border border-theme-50/50 rounded-md
                                    lg:text-theme-700 lg:hover:text-theme-900 lg:text-sm">
                                    <span><?= $menu_cta['title']; ?></span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                        <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                                    </svg>

                                </a>
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
                    class='px-4 py-2 rounded-md text-base text-theme-100 font-medium transition-colors hover:bg-theme-900/50' aria-current='page'>
                    <?= $item->title; ?>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>

</nav>