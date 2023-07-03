<?php
function clear_cache_endpoint()
{
    register_rest_route(
        'my-plugin/v1',
        '/my-endpoint',
        array(
            'methods'  => 'POST',
            'callback' => 'clear_cache',
        )
    );
}
add_action('rest_api_init', 'clear_cache_endpoint');

function clear_cache(WP_REST_Request $request)
{
    if (function_exists('rocket_clean_domain')) {
        rocket_clean_domain();
    }

    if (function_exists('rocket_clean_minify')) {
        rocket_clean_minify();
    }
    // Return a response if needed
    return new WP_REST_Response('Success', 200);
}