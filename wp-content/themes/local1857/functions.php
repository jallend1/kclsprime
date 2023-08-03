<?php

function local_1857_styles()
{
    wp_enqueue_style('local_1857_styles', get_stylesheet_uri(), array(), filemtime(get_template_directory() . '/style.css'));
}

add_action('wp_enqueue_scripts', 'local_1857_styles');

function local_1857_editor_styles()
{
    add_editor_style('editor-style.css');
}

add_action('after_setup_theme', 'local_1857_editor_styles');

// If the block being rendered is core/latest-posts, add default image if none is set
// function local_1857_default_post_image($image, $post, $args)
// {
//     if ($image) {
//         return $image;
//     }

//     return get_template_directory_uri() . '/assets/images/local1857logo.png';
// }

// add_filter('render_block_core/latest-posts', 'local_1857_default_post_image', 10, 3);


// function local_1857_excerpt_more($more)
// {
//     return '...';
// }

// add_filter('excerpt_more', 'local_1857_excerpt_more');

function local_1857_default_post_thumbnail($html, $post_id, $post_thumbnail_id, $size, $attr)
{
    if ($html) {
        return $html;
    }

    // If on single post, apply a class to the default thumbnail (Currently hidden)
    if (is_single()) {
        return '<img src="' . get_template_directory_uri() . '/assets/images/local1857logo.png" alt="Local 1857 Logo" class="local1857-default-thumbnail"/>';
    }

    return '<img src="' . get_template_directory_uri() . '/assets/images/local1857logo.png" alt="Local 1857 Logo" />';
}

add_filter('post_thumbnail_html', 'local_1857_default_post_thumbnail', 10, 5);

// If the post type is post, add a "Read More" link to the end of the excerpt
// function local_1857_excerpt_read_more_link($excerpt)
// {
//     if (get_post_type() === 'post') {
//         $excerpt .= '
//         <div class="local1857-read-more-link-container">
//             <a href="' . get_permalink() . '" class="local1857-read-more-link">Read More »</a>
//         </div>';
//     }

//     return $excerpt;
// }

// add_filter('get_the_excerpt', 'local_1857_excerpt_read_more_link');