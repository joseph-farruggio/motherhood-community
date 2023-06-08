<form action="/" method="get" class="">
    <div class="flex items-center w-full">
        <div class="flex-grow">
            <label for="search" class="screen-reader-text">Search in <?php echo home_url('/'); ?></label>
            <input type="text" name="s" placeholder="<?php echo __('Search...', 'mhc22'); ?>" id="search" value="<?php the_search_query(); ?>" class="w-full border-none outline-0 bg-[#efefef] px-4 py-3 text-base" />
        </div>

        <div><input type="submit" class="px-4 py-3 bg-black text-white uppercase text-base font-g-book font-semibold cursor-pointer outline-none border-none" value="<?php echo __('Search', 'mhc22'); ?>" /></div>
    </div>
</form>