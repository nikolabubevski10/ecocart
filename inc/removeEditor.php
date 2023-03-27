<?php

/**
 * Removes `the_content` area (editor) from the Wordpress backend, since Flynt uses ACF.
 */

namespace Flynt\RemoveEditor;

// add_action('init', function () {
//     remove_post_type_support('page', 'editor');
//     remove_post_type_support('post', 'editor');
// });

// Disable Gutenberg
add_filter('use_block_editor_for_post_type', function ($current_status, $post_type) {
    if ($post_type === 'post') {
        return false;
    }

    return $current_status;
}, 10, 2);

/**
 * Removes Gutenberg default styles on front-end
 */
add_action('wp_print_styles', function () {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('global-styles');
});
