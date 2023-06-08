<?php

function bt_breadcrumbs() {

    $defaults = [
        'seperator'     =>  '<svg class="mr-2 w-auto" width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg"><line x1="13.4812" y1="0.135978" x2="0.481155" y2="46.136" stroke="black" stroke-opacity="0.2"></line></svg>',
        'home_title'    =>  esc_html__( 'Home', '' ),
        'home_url'      =>  home_url('/'),
        'li_open'       =>  '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="inline-flex md:items-center">',
        'li_close'      =>  '</li>',
        'a_data'        =>  'itemprop="item" rel="v:url" property="v:title"'
    ];

    $sep = $defaults['seperator'];

    echo '<nav role="navigation" aria-label="Breadcrumbs" itemprop="breadcrumb" class="breadcrumb mb-2">';
    echo '<ul itemscope itemtype="http://schema.org/BreadcrumbList" class="flex text-gray-400 text-sm lg:text-base items-center">';

    // Creating home link
    echo $defaults['li_open']. '<a '. $defaults['a_data'] .' href="'. esc_url( $defaults['home_url'] ) .'"><span itemprop="name">'. esc_html( $defaults['home_title'] ) .'</span></a><meta itemprop="position" content="1">'. $sep .$defaults['li_close'];

    if ( is_single() ) {

        // Get posts type
        $post_type = get_post_type();

        // Get categories
        $category = get_the_category( $post->ID );

        // Check if the post is in a category
        if( !empty( $category ) ) {

            echo $defaults['li_open']. '<a '. $defaults['a_data'] .' href="'. esc_attr( esc_url( get_category_link($category[0]->term_id) ) ) .'"><span itemprop="name">'. esc_html( $category[0]->name ) .'</span></a><meta itemprop="position" content="2">'. $sep .$defaults['li_close'];
            echo $defaults['li_open']. '<span itemprop="name">'. get_the_title() .'</span><meta itemprop="position" content="3">'. $defaults['li_close'];

        } else {

            echo $defaults['li_open']. '<span itemprop="name">'. get_the_title() .'</span><meta itemprop="position" content="2">'. $defaults['li_close'];

        }

    } else if( is_archive() ) {

        if( is_tax() ) {
            $term = get_queried_object();
            $taxonomy = $term->taxonomy;

            if($taxonomy == 'jail_type') {

                $satate_id = get_field('select_state', $term);
                $term_state = get_term($satate_id);
                $state_url = site_url() . '/' . $term_state[0]->slug;

                echo $defaults['li_open']. '<a '. $defaults['a_data'] .' href="'. esc_url( $state_url ) .'"><span itemprop="name">'. esc_html( $term_state[0]->name ) .'</span></a><meta itemprop="position" content="2">'. $sep .$defaults['li_close'];

                $jail_name = $term->name;
                echo $defaults['li_open']. '<span itemprop="name">'. $jail_name .'</span><meta itemprop="position" content="3">'. $defaults['li_close'];

            } else if ($taxonomy == 'states') {

                $state_name = $term->name;

                echo $defaults['li_open']. '<span itemprop="name">'. $state_name .'</span><meta itemprop="position" content="2">'. $defaults['li_close'];

            } else {
                // Get posts type
                $x = 2;
                $post_type = get_post_type();

                // If post type is not post
                if( $post_type != 'post' ) {

                    $post_type_object   = get_post_type_object( $post_type );
                    $post_type_link     = get_post_type_archive_link( $post_type );

                    echo $defaults['li_open']. '<a '. $defaults['a_data'] .' href="'. esc_url( $post_type_link ) .'"><span itemprop="name">'. esc_html( $post_type_object->labels->name ) .'</span></a><meta itemprop="position" content="'. $x .'">'. $sep .$defaults['li_close'];

                    $x++;
                }

                $custom_tax_name = get_queried_object()->name;

                echo $defaults['li_open']. '<span itemprop="name">'. $custom_tax_name .'</span><meta itemprop="position" content="'. $x .'">'. $defaults['li_close'];
            }
            

        } else if ( is_category() ) {

            $x = 2;
            $parent = get_queried_object()->category_parent;

            if ( $parent !== 0 ) {

                $parent_category = get_category( $parent );
                $category_link   = get_category_link( $parent );

                echo $defaults['li_open']. '<a '. $defaults['a_data'] .' href="'. esc_url( $category_link ) .'"><span itemprop="name">'. esc_html( $parent_category->name ) .'</span></a><meta itemprop="position" content="1"><meta itemprop="position" content="'. $x .'">'. $sep .$defaults['li_close'];

                $x++;

            }

            echo $defaults['li_open']. '<span itemprop="name">'. single_cat_title( '', false ) .'</span><meta itemprop="position" content="'. $x .'">'. $defaults['li_close'];

        } else if ( is_tag() ) {

            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_name  = $terms[0]->name;

            // Display the tag name
            echo $defaults['li_open']. '<span itemprop="name">'. $get_term_name .'</span><meta itemprop="position" content="2">'. $defaults['li_close'];

        } else if( is_day() ) {

            // Day archive

            // Year link
            echo $defaults['li_open']. '<a '. $defaults['a_data'] .' href="'. esc_url( get_year_link( get_the_time('Y') ) ) .'"><span itemprop="name">'. esc_html( get_the_time('Y') ) .' Archives</span></a><meta itemprop="position" content="1"><meta itemprop="position" content="2">'. $sep .$defaults['li_close'];

            // Month link
            echo $defaults['li_open']. '<a '. $defaults['a_data'] .' href="'. esc_url( get_month_link( get_the_time('Y'), get_the_time('m') ) ) .'"><span itemprop="name">'. esc_html( get_the_time('M') ) .' Archives</span></a><meta itemprop="position" content="1"><meta itemprop="position" content="3">'. $sep .$defaults['li_close'];

            // Day display
            echo $defaults['li_open']. '<span itemprop="name">'. get_the_time('jS') .' '. get_the_time('M') .' Archives</span><meta itemprop="position" content="4">'. $defaults['li_close'];

        } else if( is_month() ) {

            // Month archive

            // Year link
            echo $defaults['li_open']. '<a '. $defaults['a_data'] .' href="'. esc_url( get_year_link( get_the_time('Y') ) ) .'"><span itemprop="name">'. esc_html( get_the_time('Y') ) .' Archives</span></a><meta itemprop="position" content="1"><meta itemprop="position" content="2">'. $sep .$defaults['li_close'];

            // Month Display
            echo $defaults['li_open']. '<span itemprop="name">'. get_the_time('M') .' Archives</span><meta itemprop="position" content="3">'. $defaults['li_close'];

        } else if ( is_year() ) {

            // Year Display
            echo $defaults['li_open']. '<span itemprop="name">'. get_the_time('Y') .' Archives</span><meta itemprop="position" content="2">'. $defaults['li_close'];

        } else if ( is_author() ) {

            // Auhor archive

            // Get the author information
            global $author;
            $userdata = get_userdata( $author );

            // Display author name
            echo $defaults['li_open']. '<span itemprop="name">Author: '. $userdata->display_name .'</span><meta itemprop="position" content="2">'. $defaults['li_close'];

        } else {

            echo $defaults['li_open']. '<span itemprop="name">'. post_type_archive_title() .'</span><meta itemprop="position" content="2">'. $defaults['li_close'];

        }

    } else if ( is_page() ) {

        // Standard page
        if( $post->post_parent ) {

            // If child page, get parents
            $anc = get_post_ancestors( $post->ID );

            // Get parents in the right order
            $anc = array_reverse( $anc );

            // Parent page loop
            if ( !isset( $parents ) ) $parents = null;
            $x = 2;
            foreach ( $anc as $ancestor ) {

                $parents .= $defaults['li_open']. '<a '. $defaults['a_data'] .' href="'. esc_url( get_permalink( $ancestor ) ) .'"><span itemprop="name">'. esc_html( get_the_title( $ancestor ) ) .'</span></a><meta itemprop="position" content="'. $x .'">'. $sep .$defaults['li_close'];
                $x++;
            }

            // Display parent pages
            echo $parents;

            // Current page
            echo $defaults['li_open']. '<span itemprop="name">'. get_the_title() .'</span><meta itemprop="position" content="'. $x .'">'. $defaults['li_close'];

        } else {

            // Just display current page if not parents
            echo $defaults['li_open']. '<span itemprop="name">'. get_the_title() .'</span><meta itemprop="position" content="2">'. $defaults['li_close'];

        }

    } else if ( is_search() ) {

        // Search results page
        echo $defaults['li_open']. '<span itemprop="name">Search results for: '. get_search_query() .'</span><meta itemprop="position" content="2">'. $defaults['li_close'];

    } else if ( is_404() ) {

        // 404 page
        echo $defaults['li_open']. '<span itemprop="name">Error 404</span><meta itemprop="position" content="2">'. $defaults['li_close'];

    }

    // End breadcrumb
    echo '</ul>';
    echo '</nav>';

}