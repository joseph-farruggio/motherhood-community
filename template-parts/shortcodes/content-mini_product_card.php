<section class="mhc-card mini-product-card border border-[#dddddd] overflow-hidden relative">

    <?php if( 'editors_pick' == $type ): ?>

    <div class="p-[1.875rem] text-center">
        <?php $editors_pick = get_field('editors_pick_color', $product_id); ?>
        <span class="absolute inline-block top-[60px] -left-[45px] py-1 px-2.5 text-white text-[13px] -tracking-[0.27px] w-60 h-[1.875rem font-g-medium -rotate-45" style="background-color:<?php echo ($editors_pick != '' ? $editors_pick : '#28bed8'); ?>;">
            <?php 
            $p_badge = get_field('product_badge', $product_id);
            $p_badge = ($p_badge != '' ? $p_badge : 'Editor\'s Pick');
            _e($p_badge, 'mhc22');
            ?>
        </span>
        <h3 class="text-[40px] leading-[40px] font-cg-medium max-w-md mx-auto mb-8"><?php _e($product->post_title, 'mhc22'); ?></h3>
        <div class="thumbnail p-5">
            <a href="<?php echo $link; ?>" target="_blank" class="block"><?php echo get_the_post_thumbnail( $product_id, 'image-500x560', array( 'class' => 'mx-auto !my-0' ) ); ?></a>
        </div>
        <p><?php the_field('summary', $product_id); ?></p>
        <a href="<?php echo $link; ?>" class="inline-block border-2 text-white h-12 leading-[3rem] text-base rounded-md px-6 font-g-medium" target="blank" style="background-color:<?php echo ($editors_pick != '' ? $editors_pick : '#28bed8'); ?>;border-color:<?php echo ($editors_pick != '' ? $editors_pick : '#28bed8'); ?>;"><?php _e('Check Latest Price', 'mhc22'); ?></a>
    </div>
    <?php if(get_field('discount_pricing_available', $product_id)): ?>
    <div class="btn-coupon">
        <a href="<?php the_field('latest_price_button_link', $product_id); ?>" target="blank"><?php the_field('discount_pricing_available', $product_id); ?></a>
    </div>
    <?php endif; ?>

    <?php else: ?>

    <div class="flex p-[1.875rem]">
        <div class="w-2/5 p-5 pb-0 text-center">
            <div class="sticky top-6">
                <div class="thumbnail p-5 pb-0">
                    <a href="<?php echo $link; ?>" target="_blank" class="block"><?php echo get_the_post_thumbnail( $product_id, 'full', array( 'class' => '!m-0' ) ); ?></a>
                </div>
                <div class="shop-btn p-5">
                    <a href="<?php echo $link; ?>" target="_blank" class="block border-2 border-secondary bg-secondary text-white w-full h-12 leading-[3rem] text-base rounded-md px-6 font-g-medium"><?php _e('Shop', 'mhc22'); ?></a>
                </div>
            </div>
        </div>
        <div class="w-3/5 p-5 pb-0">
            <div class="p-5 pb-0">
                <h3 class="mb-8"><a href="<?php echo $link; ?>" target="_blank" class="text-secondary border-b-2 border-secondary text-[40px] leading-[40px] font-cg-medium"><?php _e($product->post_title, 'mhc22'); ?></a></h3>

                <table class="w-full border-collapse">
                    <tr>
                        <th class="w-2/5 px-5 py-3.5 font-g-medium text-[1.2rem] leading-6 font-light text-left">MC Score</th>
                        <td class="text-sm font-g-book py-2 px-2.5">
                            <?php 
                                $f = get_field('cwy_score', $product_id);
                                _e($f.'%', 'mhc22');
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="w-2/5 px-5 py-3.5 font-g-medium text-[1.2rem] leading-6 font-light text-left">Therapeutic grade?</th>
                        <td class="text-sm font-g-book py-2 px-2.5">
                            <?php 
                                $f = get_field('therapeutic_grade', $product_id);
                                _e($f, 'mhc22');
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="w-2/5 px-5 py-3.5 font-g-medium text-[1.2rem] leading-6 font-light text-left">Organic or Wild-Crafted?</th>
                        <td class="text-sm font-g-book py-2 px-2.5">
                            <?php 
                                $f = get_field('organic', $product_id);
                                _e($f, 'mhc22');
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="w-2/5 px-5 py-3.5 font-g-medium text-[1.2rem] leading-6 font-light text-left">Chemical free?</th>
                        <td class="text-sm font-g-book py-2 px-2.5">
                            <?php 
                                $f = get_field('chemical-free', $product_id);
                                _e($f, 'mhc22');
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="w-2/5 px-5 py-3.5 font-g-medium text-[1.2rem] leading-6 font-light text-left">Testing available?</th>
                        <td class="text-sm font-g-book py-2 px-2.5">
                            <?php 
                                $f = get_field('testing_available', $product_id);
                                _e($f, 'mhc22');
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <?php endif; ?>

</section>