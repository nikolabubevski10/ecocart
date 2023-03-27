<?php

namespace Flynt\Components\SustainableList;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-sustainable-list',
            'title'             => __('Sustainable List'),
            'description'       => __('Sustainable List Section'),
            'render_callback'   => 'Flynt\Components\SustainableList\sustainableListFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'sustainable', 'list'],
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

function sustainableListFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/SustainableList/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $title = get_field('title');
        $animation = get_field('animation');
        $image = get_field('image');
        $list = get_field('list');
        $dot = Asset::requireUrl('Components/SustainableList/Assets/dot.svg');
        $dot_mobile_top = Asset::requireUrl('Components/SustainableList/Assets/dot-mobile-top.svg');
        $dot_mobile_middle = Asset::requireUrl('Components/SustainableList/Assets/dot-mobile-middle.svg');
        $dot_mobile_bottom = Asset::requireUrl('Components/SustainableList/Assets/dot-mobile-bottom.svg');
        $animation_list = [
            'long' => '/Components/SustainableList/Assets/sustainable/long-animation.json',
            'shopping' => [
                '/Components/SustainableList/Assets/sustainable/showcase.json',
                '/Components/SustainableList/Assets/sustainable/educate.json',
                '/Components/SustainableList/Assets/sustainable/inform.json',
                '/Components/SustainableList/Assets/sustainable/delight.json',
                '/Components/SustainableList/Assets/sustainable/attract.json',
            ]
        ];

        Timber::render('index.twig', [
            'title' => $title,
            'animation' => $animation,
            'animation_list' => $animation_list,
            'image' => $image,
            'list' => $list,
            'dot' => $dot,
            'dot_mobile_top' => $dot_mobile_top,
            'dot_mobile_middle' => $dot_mobile_middle,
            'dot_mobile_bottom' => $dot_mobile_bottom,
        ]);
    }
}
