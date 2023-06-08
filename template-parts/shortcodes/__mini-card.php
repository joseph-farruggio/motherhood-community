<section class="mini-product-card">

    <div class="row collapse text-center mini-product-card-row">
        <?php if( 'editors_pick' == $type ): ?>
            <div class="columns large-12 <?php echo $section_cls ?> inner-mini-product-card">
                <!-- <img class="editors-pick-ribbon" src="<?php echo site_url('/wp-content/themes/astra-child/assets/images/editors_pick_ribbon_corner.png') ?>"> -->
                <?php $editors_pick = get_field_object('editors_pick', $product->ID); ?>
                 <?php if( $editors_pick["value"] == true ): ?>
                        <?php if( get_field('editors_pick_color', $product->ID) ): ?>
                        <span class="badge-title top-card" style="background-color:<?php the_field('editors_pick_color', $product->ID); ?>">
                        <?php else: ?>
                        <span class="badge-title top-card">
                        <?php endif; ?>
                            <?php echo get_field('product_badge',$product->ID) ? get_field('product_badge',$product->ID) : "Editor's Pick"; ?>
                        </span>
                    <?php endif; ?> 
                <h3><?php echo $product->post_title ?></h3>

                <a href="<?php the_field('latest_price_button_link', $product->ID); ?>" target="blank"><?php echo get_the_post_thumbnail( $product ); ?></a>

                <p><?php the_field('summary', $product->ID); ?></p>
                <?php 
                        if( $affiliate_link ){
                            $link = $affiliate_link;
                        }
                        else{
                            $link = get_field('latest_price_button_link', $product->ID);
                        }
                    ?>

                <a href="<?php echo $link; ?>" class="btn" target="blank">Check Latest Price</a>
                
                <?php if(get_field('read_our_review_link', $product->ID) && get_field('read_our_review_link', $product->ID) != get_permalink()): ?>
                <br>
                <a class="link" href="<?php the_field('read_our_review_link', $product->ID); ?>" target="blank">Read our review</a>
                <?php endif; ?>

                
            </div>
            <?php if(get_field('discount_pricing_available', $product->ID)): ?>
                <div class="btn-coupon" style="">
                    <a style="" href="<?php the_field('latest_price_button_link', $product->ID); ?>" target="blank"><?php the_field('discount_pricing_available', $product->ID) ?></a>
                </div>
                <?php endif; ?>
        <?php else: ?>
            <div class="columns small-12 large-5">
                <?php 
                        if( $affiliate_link ){
                            $link = $affiliate_link;
                        }
                        else{
                            $link = get_field('latest_price_button_link', $product->ID);
                        }
                    ?>
                <div class="row">
                    <div class="columns small-12 text-center">
                        <a href="<?php echo $link; ?>"><?php echo get_the_post_thumbnail( $product ); ?></a>
                    </div>
                    <div class="columns btn-cont">
                        <a href="<?php echo $link; ?>" class="btn">Shop</a>
                    </div>
                </div>
            </div>
            <div class="columns large-9 small-12 details-cont">
                <table>
                    <tr>
                        <th colspan="2">
                            <h3><a href="<?php echo $link; ?>"><?php echo $product->post_title ?></a></h3>
                        </th>
                    </tr>
                    <!-- <tr>
                        <td>Value</td>
                        <td><?php the_field('value', $product->ID) ?></td>
                    </tr>
                    <tr>
                        <td>Size</td>
                        <td><?php the_field('size_ml', $product->ID) ?></td>
                    </tr> -->
                    <tr>
                        <td width="40%">MC Score</td>
                        <td><?php the_field('cwy_score', $product->ID) ?>%</td>
                    </tr>
                    <tr>
                        <td>Therapeutic grade?</td>
                        <td><?php the_field('therapeutic_grade', $product->ID) ?></td>
                    </tr>
                    <tr>
                        <td>Organic or Wild-Crafted?</td>
                        <td><?php the_field('organic', $product->ID) ?></td>
                    </tr>
                     <tr>
                        <td>Chemical free?</td>
                        <td><?php the_field('chemical-free', $product->ID) ?></td>
                    </tr>
                    <tr>
                        <td>Testing available?</td>
                        <td><?php the_field('testing_available', $product->ID) ?></td>
                    </tr>

                    <!-- <?php if(get_field('discount_pricing_available', $product->ID)):?>
                    <tr>
                        <td>Discount Code</td>
                        <td><?php the_field('discount_pricing_available', $product->ID) ?></td>
                    </tr>
                    <?php endif; ?> -->
                </table>
            </div>
        <?php endif; ?>
    </div>
</section>