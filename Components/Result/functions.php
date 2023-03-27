<?php

namespace Flynt\Components\Result;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-result',
            'title'             => __('Result'),
            'description'       => __('Result Section'),
            'render_callback'   => 'Flynt\Components\Result\resultFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'result'],
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

function resultFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/Result/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $pre_title = get_field('pre_title');
        $content = get_field('content');
        $animation = get_field('animation');
        $result_list = get_field('result_list');
        $animation_list = [
            '/Components/ThreeCards/Assets/case-study/lift-in-cart.json',
            '/Components/ThreeCards/Assets/case-study/of-orders.json',
            '/Components/ThreeCards/Assets/case-study/tonnes-of-c02.json',
        ];

        Timber::render('index.twig', [
            'pre_title' => $pre_title,
            'content' => $content,
            'animation' => $animation,
            'animation_list' => $animation_list,
            'result_list' => $result_list,
        ]);
    }
}

function getACFLayout()
{
    return [
        'name' => 'result',
        'label' => 'Result',
        'sub_fields' => [
            [
                'label' => 'Pre Title',
                'name' => 'pre_title',
                'type' => 'text',
                'default_value' => 'Result',
            ],
            [
                'label' => 'Content',
                'name' => 'content',
                'type' => 'textarea',
            ],
            [
                'label' => 'Animation',
                'name' => 'animation',
                'type' => 'select',
                'choices' => [
                    'none' => 'None',
                    'case-study' => 'Case Study',
                ],
                'default_value' => 'none',
            ],
            [
                'label' => 'Result List',
                'name' => 'result_list',
                'type' => 'repeater',
                'layout' => 'table',
                'sub_fields' => [
                    [
                        'label' => 'Image',
                        'name' => 'image',
                        'type' => 'image',
                    ],
                    [
                        'label' => 'Value',
                        'name' => 'value',
                        'type' => 'text',
                    ],
                    [
                        'label' => 'Title',
                        'name' => 'title',
                        'type' => 'text',
                    ],
                ],
            ],
        ]
    ];
}
