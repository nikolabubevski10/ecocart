<?php

namespace Flynt\Components\IndustryList;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-industry-list',
            'title'             => __('Industry List'),
            'description'       => __('Industry List Section'),
            'render_callback'   => 'Flynt\Components\IndustryList\industryListFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'industry'],
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

function industryListFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/IndustryList/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $title = get_field('title');
        $list = get_field('list');
        $has_animation_icon = get_field('has_animation_icon');
        $image = Asset::requireUrl('Components/IndustryList/Assets/dot.svg');
        $animation_list = [
            '/Components/IndustryList/Assets/consumer-package-group.json',
            '/Components/IndustryList/Assets/apparel.json',
            '/Components/IndustryList/Assets/cosmetics.json',
            '/Components/IndustryList/Assets/homegoods.json',
        ];

        Timber::render('index.twig', [
            'title' => $title,
            'list' => $list,
            'image' => $image,
            'has_animation_icon' => $has_animation_icon,
            'animation_list' => $animation_list,
        ]);
    }
}
