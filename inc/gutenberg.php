<?php

namespace Flynt\Gutenberg;
 
add_filter('block_categories_all', function ($block_categories, $editor_context) {
    if (! empty($editor_context->post)) {
        array_push(
            $block_categories,
            array(
                'slug'  => 'ecocart',
                'title' => 'EcoCart',
                'icon'  => null,
            )
        );
    }
    return $block_categories;
}, 10, 2);
