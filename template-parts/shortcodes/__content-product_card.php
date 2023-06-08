<section class="mhc-card product-card border border-[#dddddd] overflow-hidden relative">
	<?php if( $editors_pick["value"] == true ): ?>
		<span class="badge-title top-card">
			<?php echo get_field('product_badge',$product_id) ? get_field('product_badge',$product_id) : "Editor's Pick"; ?>
		</span>
	<?php endif; ?>	
	<?php 
    if( $affiliate_link ){
        $link = $affiliate_link;
    } else {
        $link = get_field('latest_price_button_link', $product_id);
    }
    ?>
	<div class="row">
		<div class="column">
			<h3 class="mb-8"><a href="<?php echo $link; ?>" target="_blank" class="text-secondary border-b-2 border-secondary text-[40px] leading-[40px] font-cg-medium"><?php _e($product->post_title, 'mhc22'); ?></a></h3>
			<h5><?php _e(get_field('subheadline_product', $product_id), 'mhc22'); ?></h5>
		</div>
	</div>
	<div class="row">
		<div class="column text-center">
			<a class="img-link" href="<?php echo $link; ?>"><?php echo get_the_post_thumbnail( $product ); ?></a>
		</div>
	</div>
	<div class="row">
		<div class="column">
			<ul class="accordion" data-accordion data-allow-all-closed="true">
                <li>
                    <table class="table-0">
                        <tr>
                            <td>
                                <h6><?php echo $cwy_score["label"] ?></h6>
                                <span class="score-value"><?php echo $cwy_score["value"] ?>%</span>
                            </td>
                            <td class="round-badge">
                                <?php if( $editors_pick["value"] == true ): ?>
                                    <div class="blue-badge row align-middle">
                                        <div class="row align-middle">
                                            <span class="badge-title"><?php echo get_field('product_badge',$product_id) ? get_field('product_badge',$product_id) : "Editor's Pick"; ?></span>
                                        </div>
                                    </div>
                                <?php endif; ?>   
                            </td>
                        </tr>
                    </table>
                </li>
                <?php if(get_field('summary', $product_id)):?>
				<li class="accordion-item" data-accordion-item>
					<a href="#" class="accordion-title">Summary</a>
					<div class="accordion-content" data-tab-content > 
						<div class="row">
							<div class="columns">
								<p><?php the_field('summary', $product_id); ?></p>
							</div>
						</div>
						<?php if( have_rows('pros_and_cons', $product_id) ): ?>
							<div class="row">
								<div class="columns">
									
									<table class="table-3 pros-cons">
										<tr>
											<th><h6>Pro's</h6></th>
											<th><h6>Cons's</h6></th>
										</tr>
									<?php while( have_rows('pros_and_cons', $product_id) ): the_row(); ?>
										<tr>
                                            <td>
                                                <?php if(get_sub_field('pros')): ?>
                                                    <span class="icon icon-checkmark">&nbsp</span><?php echo get_sub_field('pros'); ?>
                                                <?php endif; ?>
                                            <td>
                                                <?php if(get_sub_field('cons')): ?>
                                                    <span class="icon icon-cross">&nbsp</span><?php echo get_sub_field('cons'); ?>
                                                <?php endif; ?>
                                            </td>
										</tr>
									<?php endwhile; ?>
									</table>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</li>
				<?php endif;?>
			</ul>
			<a href="<?php echo $link; ?>" class="btn" style="background-color: <?php the_field('button_color', $product_id); ?> !important">Check Latest Price</a>
        
            <?php if(get_field('discount_pricing_available', $product->ID)): ?>
                <div class="btn-coupon text-center">
                    <a href="<?php echo $link; ?>" target="blank"><?php the_field('discount_pricing_available', $product->ID) ?></a>
                </div>
            <?php endif; ?>

        </div>
	</div>
</section>