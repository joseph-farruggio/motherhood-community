<?php $item = $args['item']; ?>
<div class="sm:columns-2">
    <?php foreach ($item->children as $child): ?>
        <?php $parent_class = isset($child->children) ? 'font-semibold' : ''; ?>
        <a href="<?= $child->url; ?>" class="<?= $parent_class; ?> text-gray-900 lg:text-[#604E4F] block mb-2 hover:underline mt-4 first:mt-0">
            <?= $child->title; ?>
        </a>

        <?php if (isset($child->children)): ?>

            <?php foreach ($child->children as $grandchild): ?>
                <a href="<?= $grandchild->url; ?>" class="font-normal text-base text-gray-900 lg:text-[#776062] block hover:underline">
                    <?= $grandchild->title; ?>
                </a>
            <?php endforeach; ?>

        <?php endif; ?>
    <?php endforeach; ?>
</div>