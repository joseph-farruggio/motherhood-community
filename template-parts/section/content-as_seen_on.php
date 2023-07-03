<?php if (have_rows('logos_asolmcoptions', 'option')): ?>
    <section id="partners-logo" class="partners-logo pt-8 pb-14 bg-light" aria-label="Partners Logo">
        <div class="max-w-7xl px-5 mx-auto">

            <?php if (get_field('heading_asolmcoptions', 'option')): ?>
                <h3 class="sec-heading text-xs font-bold font-g-book uppercase tracking-widest text-center mb-10 relative after:content-[''] after:w-full after:h-px after:bg-[#979797]/[.3] after:absolute after:left-0 after:top-2/4">
                    <span class="bg-light px-4 inline-block relative z-[1]"><?php the_field('heading_asolmcoptions', 'option'); ?></span>
                </h3>
            <?php endif; ?>
            <ul class="snap-x flex flex-nowrap gap-4 lg:gap-8 items-center overflow-scroll no-scrollbar">

                <?php while (have_rows('logos_asolmcoptions', 'option')):
                    the_row(); ?>
                    <li class="snap-center p-1 shrink-0">
                        <?php echo wp_get_attachment_image(get_sub_field('add_image'), 'full', "", array("class" => "mx-auto")); ?>
                    </li>
                <?php endwhile; ?>

            </ul>

        </div>
    </section>
<?php endif; ?>