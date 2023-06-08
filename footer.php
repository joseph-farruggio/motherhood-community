
</main>

<?php do_action( 'tailpress_content_end' ); ?>

</div>

<?php get_template_part( 'template-parts/section/content', 'signup' ); ?>

<?php do_action( 'tailpress_content_after' ); ?>

<nav class="footer-nav border-t border-[#979797]/[0.3]">
	<div class="mx-auto max-w-7xl">
		<div class="flex flex-col md:flex-row md:justify-between md:items-center px-[.938rem]">
			<div class="hidden md:block max-w-[12.188rem] py-2.5">
				<?php if ( has_custom_logo() ) { ?>
					<?php the_custom_logo(); ?>
				<?php } ?>
			</div>

			<?php
			wp_nav_menu(
				array(
					'container_id'    => 'footer-menu',
					'container_class' => 'md:px-[.938rem]',
					'theme_location'  => 'footer',
					'menu_class'      => 'footer-menu flex flex-col md:flex-row flex-wrap justify-center',
					'li_class'        => 'text-sm font-g-medium uppercase md:mx-2 px-[8px] md:px-0 py-[15px] md:py-0 border-b md:border-b-0 border-[#979797]/[0.3]',
					'fallback_cb'     => false,
				)
			);
			?>

			<div class="items-center px-[.938rem] border-l self-stretch hidden lg:flex desktop">
				<a href="javascript:;" class="search-form-icon">
					<?php icon_search(); ?>
				</a>
				<a href="javascript:;" class="x-icon hidden">
					<?php icon_x(); ?>
				</a>
			</div>

			<div class="lang flex self-stretch items-center border-l-0 md:border-l border-[#979797]/[0.3]">
				<?php do_action('wpml_language_switcher'); ?>
			</div>
		</div>
	</div>
</nav>

<footer id="colophon" class="site-footer border-t border-[#979797]/[0.3] py-10" role="contentinfo">
	<?php do_action( 'tailpress_footer' ); ?>

	<div class="container mx-auto text-center font-g-book text-sm text-[#A9A9A9]">
		<div class="flex justify-center items-center">
			<?php wp_nav_menu( array(
				'container_id'    => 'footer2-menu',
				'theme_location'  => 'footer2',
				'menu_class'      => 'footer-bottom-menu flex flex-wrap',
				'li_class'        => 'font-g-book text-sm text-[#A9A9A9] px-2 border-r',
				'fallback_cb'     => false,
			) ); ?>
		</div>

		<div id="footer-branding" class="text-xs font-g-book font-normal block text-center text-black mt-2.5"><?php _e('Exclusive Member of Mediavine Family', 'mhc22'); ?></div>
	</div>
</footer>

</div>

<script>
//
let gRecaptchaR = document.querySelectorAll(".ginput_recaptcha");
if (typeof gRecaptchaR != "undefined" && gRecaptchaR != null) {
  gRecaptchaR.forEach((element, i) => {
	let thisID = element.id;
	element.id = thisID+'_'+i;
  });
}
</script>
<?php wp_footer(); ?>
<script>
/**
 * Lazy Load Images using Intersection Observer
 * 
 */
var observer = new IntersectionObserver(onIntersect);
document.querySelectorAll("[data-lazy]").forEach((img) => {
	observer.observe(img);
});

function onIntersect(entries) {
	entries.forEach((entry) => {
		if (entry.target.getAttribute("loading") == 'not_lazy' || ! entry.target.hasAttribute("data-src") || entry.target.getAttribute("data-processed") || !entry.isIntersecting)
			return true;
		entry.target.setAttribute("src", entry.target.getAttribute("data-src"));
		entry.target.setAttribute("data-processed", true);
	});
}

/**
 * (Trying to) Not lazy load above the fold images
 */
document.addEventListener('DOMContentLoaded',() => {
	
	win_height = window.innerHeight;
	imgs = document.getElementsByTagName('img');
	for (var i = 0; i < imgs.length; i++) {
		// At least 20 px above the fold
		if( imgs[i].getAttribute("loading") != 'not_lazy' && (imgs[i].offsetTop+20) < win_height && imgs[i].hasAttribute("data-src") ){
			imgs[i].setAttribute("src", imgs[i].getAttribute("data-src"));
			imgs[i].setAttribute("data-processed", true);
		} 
	}

});
</script>
</body>
</html>
