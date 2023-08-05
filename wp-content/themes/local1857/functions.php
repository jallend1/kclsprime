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

function local_1857_default_post_thumbnail($html, $post_id, $post_thumbnail_id, $size, $attr)
{
    if ($html) {
        return $html;
    }

    // If on single post, apply a class to the default thumbnail (Currently hidden)
    if (is_single() || is_page()) {
        return '<img src="' . get_template_directory_uri() . '/assets/images/local1857logo.png" alt="Local 1857 Logo" class="local1857-default-thumbnail"/>';
    }

    return '<img src="' . get_template_directory_uri() . '/assets/images/local1857logo.png" alt="Local 1857 Logo" />';
}

add_filter('post_thumbnail_html', 'local_1857_default_post_thumbnail', 10, 5);