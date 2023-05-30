<?php

function local_1857_styles()
{
    wp_enqueue_style('local_1857_styles', get_stylesheet_uri(), array(), filemtime(get_template_directory() . '/style.css'));
}

function local_1857_editor_styles()
{
    add_editor_style('editor-style.css');
}

// If the block being rendered is core/latest-posts, if the post does not have a featured image, then make local1857logo.png the default
function local_1857_default_post_image($image, $post, $args)
{
    echo '<pre>';
    print_r($image);
    echo '</pre>';
    if ($image) {
        return $image;
    }

    return get_template_directory_uri() . '/assets/images/local1857logo.png';
}

add_filter('render_block_core/latest-posts', 'local_1857_default_post_image', 10, 3);


add_action('wp_enqueue_scripts', 'local_1857_styles');
add_action('after_setup_theme', 'local_1857_editor_styles');
