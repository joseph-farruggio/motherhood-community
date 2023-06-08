<div class="author-section flex gap-5 justify-items-center items-center py-5 border-b border-[#e6e6e6]">
    <?php $doc = get_field('medical_reviewer', get_the_ID()); ?>
    <?php $author_id = get_the_author_meta('ID'); ?>
    <div class="author-flex-img w-3/12"><a href="<?php echo get_author_posts_url( $author_id ); ?>"><?php  echo get_avatar( $author_id, 100, null, null, ['class'=>'rounded-full','extra_attr'=>'loading="not_lazy"'] );  ?></a></div>
    <div class="author-flex-txt w-9/12">
        <h5 class="text-xl font-semibold">
            <span>By <a href="<?php echo get_author_posts_url( $author_id ); ?>" class="underline text-primary hover:text-secondary"><?php echo get_the_author(); ?></a> <?php // echo get_the_modified_date('F j, Y', get_the_ID()); ?></span>
            <?php if( $doc ): ?>
                <?php $author_credentials = get_field('credentials', 'user_'. $doc['ID'] ); ?>
                <span> - Medically reviewed by <a href="<?php echo get_author_posts_url( $doc['ID'] ); ?>" class="underline text-primary hover:text-secondary">Dr. <?php echo $doc['display_name'].' '.$author_credentials; ?></a></span>
            <?php endif; ?>
        </h5>
    </div>
</div>