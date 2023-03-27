<?php

namespace Flynt\Components\Fit;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-fit',
            'title'             => __('Fit'),
            'description'       => __('Fit Section'),
            'render_callback'   => 'Flynt\Components\Fit\fitFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'fit'],
            'example'           => [
                'attributes' => [
                    'mode' => 'preview',
                    'data' => [
                        'is_example' => true
                    ]
                ]
            ]
        ]);
    }
});

function fitFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/Fit/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $pre_title = get_field('pre_title');
        $list = get_field('list');
        $link = get_field('link');

        Timber::render('index.twig', [
            'pre_title' => $pre_title,
            'list' => $list,
            'link' => $link,
        ]);
    }
}
