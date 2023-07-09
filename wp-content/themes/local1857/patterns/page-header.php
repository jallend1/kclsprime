<?php

/**
 * Title: Local 1857 Page Header
 * Slug: local1857/page-header
 * Categories: text, header
 */
?>

<!-- wp:cover {"url":"<?php echo esc_url(get_theme_file_uri('assets/images/bookshelf.jpg')); ?>","dimRatio":50,"focalPoint":{"x":0.5,"y":0.3},"minHeight":259,"minHeightUnit":"px","contentPosition":"bottom center","layout":{"type":"default"}} -->
<div class="wp-block-cover has-custom-content-position is-position-bottom-center" style="min-height:259px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim"></span><img class="wp-block-cover__image-background" alt="" src="<?php echo esc_url(get_theme_file_uri('assets/images/bookshelf.jpg')); ?>" style="object-position:50% 30%" data-object-fit="cover" data-object-position="50% 30%"/>
    <div class="wp-block-cover__inner-container">
        <!-- If the URL indicates search results, display the search terms -->
        <?php if (strpos($_SERVER['REQUEST_URI'], '/?s=') !== false) : ?>
            <!-- wp:query-title {"type":"search","textAlign":"center","level":1,"className":"local1857-search-header"} /-->
        <!-- If it's just a regular page, display the title -->
        <?php else : ?>
            <!-- wp:post-title {"className":"local1857-page-title"} /-->
        <?php endif; ?>
    </div>
</div>
<!-- /wp:cover -->