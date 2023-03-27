<?php

namespace Flynt\Components\ThreeCards;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-three-cards',
            'title'             => __('Three Cards'),
            'description'       => __('Three Cards Section'),
            'render_callback'   => 'Flynt\Components\ThreeCards\threeCardsFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'card'],
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

function threeCardsFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/ThreeCards/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $animation = get_field('animation');
        $card_list = get_field('card_list');
        $animation_list = [
            '/Components/ThreeCards/Assets/case-study/lift-in-cart.json',
            '/Components/ThreeCards/Assets/case-study/of-orders.json',
            '/Components/ThreeCards/Assets/case-study/tonnes-of-c02.json',
        ];

        Timber::render('index.twig', [
            'animation' => $animation,
            'animation_list' => $animation_list,
            'card_list' => $card_list,
        ]);
    }
}

function getACFLayout()
{
    return [
        'name' => 'threeCards',
        'label' => 'Three Cards',
        'sub_fields' => [
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
                'label' => 'Card List',
                'name' => 'card_list',
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
                    ]
                ],
            ],
        ]
    ];
}
