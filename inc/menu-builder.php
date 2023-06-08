<?php

function build_nested_menu($menu_items, $parent_id = 0)
{
    $menu = array();
    foreach ($menu_items as $menu_item) {
        if ($menu_item->menu_item_parent == $parent_id) {
            $children = build_nested_menu($menu_items, $menu_item->ID);
            if (!empty($children)) {
                $menu_item->children = $children;
            }
            $menu[] = $menu_item;
        }
    }

    return $menu;
}