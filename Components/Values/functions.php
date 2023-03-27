<?php

namespace Flynt\Components\Values;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-values',
            'title'             => __('Values'),
            'description'       => __('Values Section'),
            'render_callback'   => 'Flynt\Components\Values\valuesFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'values'],
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

function valuesFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/Values/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $pre_title = get_field('pre_title');
        $animation = get_field('animation');
        $value_list = get_field('value_list');
        $animation_list = [
            '/Components/Values/Assets/about-us/velocity.json',
            '/Components/Values/Assets/about-us/relentlessly.json',
            '/Components/Values/Assets/about-us/be-transparent.json',
            '/Components/Values/Assets/about-us/work-like.json',
            '/Components/Values/Assets/about-us/passion-over.json',
            '/Components/Values/Assets/about-us/be-an-owner.json',
        ];

        Timber::render('index.twig', [
            'pre_title' => $pre_title,
            'animation' => $animation,
            'animation_list' => $animation_list,
            'value_list' => $value_list,
        ]);
    }
}
