<?php

namespace Flynt\Components\HowList;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-how-list',
            'title'             => __('How List'),
            'description'       => __('How List Section'),
            'render_callback'   => 'Flynt\Components\HowList\howListFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'how', 'list'],
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

function howListFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/HowList/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $title = get_field('title');
        $list = get_field('list');
        $animation = get_field('animation');
        $dot_desktop = Asset::requireUrl('Components/HowList/Assets/dot-desktop.svg');
        $dot_mobile = Asset::requireUrl('Components/HowList/Assets/dot-mobile.svg');

        Timber::render('index.twig', [
            'title' => $title,
            'list' => $list,
            'animation' => $animation,
            'dot_desktop' => $dot_desktop,
            'dot_mobile' => $dot_mobile,
        ]);
    }
}
