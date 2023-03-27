<?php

namespace Flynt\Components\Challenge;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-challenge',
            'title'             => __('Challenge'),
            'description'       => __('Challenge Section'),
            'render_callback'   => 'Flynt\Components\Challenge\challengeFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'challenge'],
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

function challengeFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/Challenge/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $pre_title = get_field('pre_title');
        $content = get_field('content');

        Timber::render('index.twig', [
            'pre_title' => $pre_title,
            'content' => $content,
        ]);
    }
}

function getACFLayout()
{
    return [
        'name' => 'challenge',
        'label' => 'Challenge',
        'sub_fields' => [
            [
                'label' => 'Pre Title',
                'name' => 'pre_title',
                'type' => 'text',
                'default_value' => 'Challenge',
            ],
            [
                'label' => 'Content',
                'name' => 'content',
                'type' => 'textarea',
            ]
        ]
    ];
}
