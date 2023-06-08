<?php $item = $args['item']; ?>
<?php foreach ($item->children as $child): ?>
    <?php $parent_class = isset($child->children) ? 'font-semibold' : ''; ?>
    <a href="<?= $child->url; ?>" class="<?= $parent_class; ?> text-gray-900 block mt-2 first:mt-0 mb-2 hover:underline">
        <?= $child->title; ?>
    </a>

    <?php if (isset($child->children)): ?>

        <?php foreach ($child->children as $grandchild): ?>
            <a href="<?= $grandchild->url; ?>" class="font-normal text-base text-gray-900 block hover:underline">
                <?= $grandchild->title; ?>
            </a>
        <?php endforeach; ?>

    <?php endif; ?>
<?php endforeach; ?>