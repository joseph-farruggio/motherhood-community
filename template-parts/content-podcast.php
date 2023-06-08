<?php if( get_field('full_transcript') || get_field('transcript_excerpt') ) { ?>

    <h3 class="my-8 text-[40px] leading-none text-black font-cg-medium"><?php _e('Transcript', 'mhc22'); ?></h3>
    <?php the_field('transcript_excerpt'); ?>

    <div id="fullTrans" class="hidden">
        <?php the_field('full_transcript'); ?>
    </div>

    <a href="javascript:;" class="bg-black rounded-md px-4 h-[55px] leading-[55px] text-secondary font-g-book text-base font-bold inline-block border-b-2 border-secondary hover:bg-secondary hover:text-white hover:border-black" id="transBtn"><?php _e('Read full transcript', 'mhc22'); ?></a>

<?php } ?>