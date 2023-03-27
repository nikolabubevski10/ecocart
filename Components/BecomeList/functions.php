<?php

namespace Flynt\Components\BecomeList;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-become-list',
            'title'             => __('Become List'),
            'description'       => __('Become List Section'),
            'render_callback'   => 'Flynt\Components\BecomeList\becomeListFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'become', 'list'],
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

function becomeListFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/BecomeList/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $sub_title_1 = get_field('sub_title_1');
        $title_1 = get_field('title_1');
        $content_1 = get_field('content_1');
        $image_1 = get_field('image_1');
        $list = get_field('list');
        $sub_title_2 = get_field('sub_title_2');
        $image_2 = get_field('image_2');
        $sub_title_3 = get_field('sub_title_3');
        $afford_list = get_field('afford_list');
        $afford_link = get_field('afford_link');
        $animation = get_field('animation');
        $dot = Asset::requireUrl('Components/BecomeList/Assets/dot.svg');
        $dot_mobile = Asset::requireUrl('Components/BecomeList/Assets/dot-mobile.svg');
        $animation_list = [
            'top' => '/Components/BecomeList/Assets/become-carbon-neutral/calculate.json',
            'middle' => [
                '/Components/BecomeList/Assets/become-carbon-neutral/reduce.json',
                '/Components/BecomeList/Assets/become-carbon-neutral/offset.json',
            ],
            'bottom' => '/Components/BecomeList/Assets/become-carbon-neutral/long-animation.json',
        ];

        Timber::render('index.twig', [
            'sub_title_1' => $sub_title_1,
            'title_1' => $title_1,
            'content_1' => $content_1,
            'image_1' => $image_1,
            'list' => $list,
            'sub_title_2' => $sub_title_2,
            'image_2' => $image_2,
            'sub_title_3' => $sub_title_3,
            'afford_list' => $afford_list,
            'afford_link' => $afford_link,
            'animation' => $animation,
            'animation_list' => $animation_list,
            'dot' => $dot,
            'dot_mobile' => $dot_mobile,
        ]);
    }
}
