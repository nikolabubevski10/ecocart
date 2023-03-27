<?php

namespace Flynt\Components\FourCards;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-four-cards',
            'title'             => __('Four Cards'),
            'description'       => __('Four Cards Section'),
            'render_callback'   => 'Flynt\Components\FourCards\fourCardsFunc',
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

function fourCardsFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/FourCards/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $card_list = get_field('card_list');

        Timber::render('index.twig', [
            'card_list' => $card_list,
        ]);
    }
}

function getACFLayout()
{
    return [
        'name' => 'fourCards',
        'label' => 'Four Cards',
        'sub_fields' => [
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
                        'label' => 'Title',
                        'name' => 'title',
                        'type' => 'text',
                    ],
                    [
                        'label' => 'Content',
                        'name' => 'content',
                        'type' => 'textarea',
                    ]
                ]
            ]
        ]
    ];
}
