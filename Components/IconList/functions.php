<?php

namespace Flynt\Components\IconList;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-icon-list',
            'title'             => __('Icon List'),
            'description'       => __('Icon List Section'),
            'render_callback'   => 'Flynt\Components\IconList\iconListFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'resource'],
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

function iconListFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/IconList/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $icon_list = get_field('icon_list');
        $animation = get_field('animation');
        $dot_desktop = Asset::requireUrl('Components/IconList/Assets/dot-desktop.svg');
        $dot_mobile = Asset::requireUrl('Components/IconList/Assets/dot-mobile.svg');
        $animation_list = [
            '/Components/IconList/Assets/careers/competitive-salary.json',
            '/Components/IconList/Assets/careers/unlimited-pto.json',
            '/Components/IconList/Assets/careers/full-health.json',
            '/Components/IconList/Assets/careers/mental-health.json',
            '/Components/IconList/Assets/careers/401-k.json',
            '/Components/IconList/Assets/careers/a-seat-at.json',
            '/Components/IconList/Assets/careers/carbon-neutral.json',
            '/Components/IconList/Assets/careers/remote-working.json',
        ];

        Timber::render('index.twig', [
            'icon_list' => $icon_list,
            'animation' => $animation,
            'animation_list' => $animation_list,
            'dot_desktop' => $dot_desktop,
            'dot_mobile' => $dot_mobile,
        ]);
    }
}
