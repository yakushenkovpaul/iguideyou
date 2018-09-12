<?php

/**
* Deasil Custom Function
*/

/*Custom Search*/
if(!function_exists('deasil_search_form')) {
function deasil_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
                <div class="input-group">
                    <label class="screen-reader-text" for="s">' . esc_html__( 'Search', 'deasil' ) . '</label>
                    <input type="text" class="form-control" value="' . get_search_query() . '" name="s" id="s" />
                    <div class="input-group-btn">
                        <input type="submit" class="btn btn-primary" id="searchsubmit" value="'. esc_attr__( 'Search', 'deasil' ) .'" />
                     </div>
                </div>
            </form>';

return $form;
}
add_filter( 'get_search_form', 'deasil_search_form', 100 );
}


/*Custom Excerpt length*/
if(!function_exists('deasil_excerpt_length')) {
function deasil_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'deasil_excerpt_length', 999 );
}

/*with specific character*/
function deasil_get_excerpt($limit, $source = null){
    if($source == "content" ? ($excerpt = get_the_content()) : ($excerpt = get_the_excerpt()));
    $excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
    return $excerpt;
}
/*
Usage
echo deasil_get_excerpt(21);  
echo deasil_get_excerpt(140, 'content'); 
*/


// add more link to excerpt
if(!function_exists('deasil_custom_excerpt_more')) {
function deasil_custom_excerpt_more($more) {
    global $post;
    return '<a class="more-link" href="'. get_permalink($post->ID) . '">'. esc_html__('..', 'deasil') .'</a>';
}
add_filter('excerpt_more', 'deasil_custom_excerpt_more');
}

// add excerpt to pages
if(!function_exists('deasil_add_excerpts_to_pages')) {
function deasil_add_excerpts_to_pages() {
    add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'deasil_add_excerpts_to_pages' );
}


// Simply remove anything that looks like an archive title prefix ("Archive:", "Foo:", "Bar:").
add_filter('get_the_archive_title', function ($title) {
    $string = '<span>' . preg_replace('/:/', ':</span>', $title);
    return $string;
});