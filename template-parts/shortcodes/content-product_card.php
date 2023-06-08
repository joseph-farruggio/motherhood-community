<div class="mhc-card product-card border border-[#dddddd] overflow-hidden relative p-[3.125rem]">
	<?php 
    if( $affiliate_link ){
        $link = $affiliate_link;
    } else {
        $link = get_field('latest_price_button_link', $product_id);
    }
    ?>
    <?php $editors_pick = get_field('editors_pick_color', $product_id); ?>
    <span class="absolute inline-block top-[60px] -left-[45px] py-1 px-2.5 text-white text-[13px] -tracking-[0.27px] w-60 h-[1.875rem font-g-medium -rotate-45 text-center" style="background-color:<?php echo ($editors_pick != '' ? $editors_pick : '#28bed8'); ?>;">
        <?php 
        $p_badge = get_field('product_badge', $product_id);
        $p_badge = ($p_badge != '' ? $p_badge : 'Editor\'s Pick');
        _e($p_badge, 'mhc22');
        ?>
    </span>

    <div class="heading text-center">
        <h3 class="mb-8 max-w-[400px] mx-auto"><a href="<?php echo $link; ?>" target="_blank" class="text-secondary border-b-2 border-secondary text-[40px] leading-[40px] font-cg-medium"><?php _e($product->post_title, 'mhc22'); ?></a></h3>
        <h5 class="text-[28px] leading-[1em] -tracking-[0.37px] text-secondary !font-g-book mb-6"><?php _e(get_field('subheadline_product', $product_id), 'mhc22'); ?></h5>
    </div>

    <div class="thumbnail p-5">
        <a href="<?php echo $link; ?>" target="_blank" class="block"><?php echo get_the_post_thumbnail( $product_id, 'image-500x560', array( 'class' => 'mx-auto !my-0' ) ); ?></a>
    </div>

    <div class="info-badge flex gap-40">
        <div>
            <h6 class="text-xl font-g-medium mb-3"><?php echo $cwy_score["label"] ?></h6>
            <span class="score-value text-[100px] font-g-medium leading-[1em] font-bold"><?php echo $cwy_score["value"] ?>%</span>
        </div>
        <div class="relative">
            <div class="h-[129px] w-[129px] rounded-full bg-white shadow-[0_2px_4px_0_rgba(0,0,0,0.5)] border-[10px] rotate-[20deg] relative" style="border-color:<?php echo ($editors_pick != '' ? $editors_pick : '#28bed8'); ?>;">
                <span class="block py-1 text-white text-[13px] -tracking-[0.27px] w-full h-[1.875rem font-g-medium text-center absolute top-2/4 left-2/4 -translate-x-[50%] -translate-y-[50%]" style="background-color:<?php echo ($editors_pick != '' ? $editors_pick : '#28bed8'); ?>;">
                    <?php _e($p_badge, 'mhc22'); ?>
                </span>
            </div>
        </div>
    </div>

    <div class="accordion">
        <div class="accordion-item bg-white border-y">
            <h2 class="accordion-header !mb-0">
                <button class="accordion-button relative flex items-center justify-between w-full py-4 text-base text-secondary font-g-medium text-left bg-white border-0 rounded-none transition focus:outline-none" data-bs-target="#collapseOne">
                    <span><?php _e('Summary', 'mhc22'); ?></span>
                    <span>+</span>
                </button>
            </h2>
            <div id="collapseOne" class="border-t border-secondary hidden">
                <div class="accordion-body py-4">
                    <p><?php the_field('summary', $product_id); ?></p>
                    <?php if( have_rows('pros_and_cons', $product_id) ): ?>
                    <table class="table-auto border-collapse w-full text-left">
                        <thead>
                            <tr>
                                <th><h6><?php _e('Pro\'s', 'mhc22'); ?></h6></th>
                                <th><h6><?php _e('Cons\'s', 'mhc22'); ?></h6></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while( have_rows('pros_and_cons', $product_id) ): the_row(); ?>
                            <tr>
                                <td>
                                    <?php if(get_sub_field('pros')): ?>
                                        <span class="icon-checkmark inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#63bf2c" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg></span> <?php _e(get_sub_field('pros'), 'mhc22'); ?>
                                    <?php endif; ?>
                                <td>
                                    <?php if(get_sub_field('cons')): ?>
                                        <span class="icon-cross inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" stroke="#f44335" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg></span> <?php _e(get_sub_field('cons'), 'mhc22'); ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-10">
        <a href="<?php echo $link; ?>" class="inline-block border-2 text-white h-12 leading-[3rem] text-lg w-full rounded-md px-6 font-g-medium" target="blank" style="background-color:<?php echo ($editors_pick != '' ? $editors_pick : '#28bed8'); ?>;border-color:<?php echo ($editors_pick != '' ? $editors_pick : '#28bed8'); ?>;"><?php _e('Check Latest Price', 'mhc22'); ?></a>

        <?php if(get_field('discount_pricing_available', $product_id)): ?>
            <a href="<?php echo $link; ?>" target="blank"><?php _e(get_field('discount_pricing_available', $product_id), 'mhc22'); ?></a>
        <?php endif; ?>
    </div>

</div>