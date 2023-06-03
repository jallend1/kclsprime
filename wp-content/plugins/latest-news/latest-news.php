<?php

/**
 * Plugin Name:       Local 1857 Latest News
 * Description:       Displays the latest blog posts
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           1.1.0
 * Author:            Two Dogs Web Development
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       latest-news
 *
 * @package           local1857
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */

function local1857_latest_news_block_renderer($attr)
{
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 4,
        'orderby' => 'date',
        'order' => 'DESC'
    );
    $the_query = new WP_Query($args);
    ob_start();
?>
    <section class="local1857-latest-news-block">
        <div class="local1857-recent-posts">
            <?php if ($the_query->have_posts()) ?>
            <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                <div class="local1857-news-card">
                    <div class="local1857-news-image">
                        <?php if (has_post_thumbnail()) {
                            the_post_thumbnail('large');
                        }
                        // If no featured image, display the first image from the post or default logo
                        else {
                            $local1857_post_img = local1857_get_post_image();
                            echo '<img src="' . $local1857_post_img . '" alt="' . get_the_title() . '">';
                        } ?>
                    </div>
                    <div class="local1857-news-content">
                        <a href="<?php the_permalink(); ?>">
                            <h3><?php the_title(); ?></h3>
                        </a>
                        <p class="local1857-recent-post-time"><?php the_date('F j, Y'); ?></p>
                        <div class="local1857-recent-post-expanded">
                            <p>
                                <?php echo get_first_25_words(); ?>
                            </p>
                        </div>
                        <div class="wp-block-button local1857-read-more-section">
                            <a class="wp-block-button__link w-element-button local1857-read-more" href="<?php the_permalink(); ?>">Read More</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>
<?php
    wp_reset_postdata();
    return ob_get_clean();
}

function get_first_25_words()
{
    $local1857_post_content = get_the_content();
    $local1857_post_content = strip_tags($local1857_post_content);
    $local1857_post_content = explode(' ', $local1857_post_content);
    $local1857_post_content = array_slice($local1857_post_content, 0, 25);
    $local1857_post_content = implode(' ', $local1857_post_content);
    return $local1857_post_content;
}

function local1857_get_post_image()
{
    global $post;
    $first_img = '';
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    if (count($matches[1]) > 0) {
        $first_img = $matches[1][0];
    } else {
        // If no image is found, display local1857logo.png from the plugin's root directory
        $first_img = plugin_dir_url(__FILE__) . 'local1857logo.png';
    }
    return $first_img;
}

function local1857_latest_news_block_init()
{
    register_block_type(
        __DIR__ . '/build',
        array(
            'render_callback' => 'local1857_latest_news_block_renderer'
        )
    );
}

add_action('init', 'local1857_latest_news_block_init');
