<?php
$item = $args['item'];

$columnCount = get_field('column_count', $item->ID);

$columnClass = $columnCount > 0 ? "grid gap-2 sm:gap-x-6 lg:gap-4 xl:gap-8" : "";

if ($columnCount == 2) {
    $columnClass .= " grid-cols-1 sm:grid-cols-2";
}

if ($columnCount == 4) {
    $columnClass .= " grid-cols-1 sm:grid-cols-2 lg:grid-cols-4";
}
?>
<div class="<?= $columnClass; ?>">
    <?php foreach ($item->children as $child): ?>
        <?php $isGrid = get_field('layout', $child->ID) == 'grid'; ?>

        <?php if ($isGrid) { ?><div><?php } ?>

            <a href="<?= $child->url; ?>" class="font-semibold text-gray-900 block mb-2 hover:underline lg:text-[#604E4F]">
                <?= $child->title; ?>
            </a>

            <?php if (isset($child->children)): ?>
                <?php if ($isGrid) { ?> <div class="mt-4 space-y-2"> <?php } ?>

                    <?php foreach ($child->children as $grandchild): ?>
                        <a href="<?= $grandchild->url; ?>" class="font-normal text-base text-gray-900 block hover:underline lg:text-[#776062]">
                            <?= $grandchild->title; ?>
                        </a>
                    <?php endforeach; ?>

                    <?php if ($isGrid) { ?>
                    </div><?php } ?>
            <?php endif; ?>

            <?php if ($isGrid) { ?>
            </div><?php } ?>
    <?php endforeach; ?>
</div>