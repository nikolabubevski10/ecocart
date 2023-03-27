<?php

namespace Flynt\Components\About;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-about',
            'title'             => __('About'),
            'description'       => __('About Section'),
            'render_callback'   => 'Flynt\Components\About\aboutFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'about'],
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

function aboutFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/About/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $pre_title = get_field('pre_title');
        $title = get_field('title');
        $content = get_field('content');

        Timber::render('index.twig', [
            'pre_title' => $pre_title,
            'title' => $title,
            'content' => $content,
        ]);
    }
}

function getACFLayout()
{
    return [
        'name' => 'about',
        'label' => 'About',
        'sub_fields' => [
            [
                'label' => 'Pre Title',
                'name' => 'pre_title',
                'type' => 'text',
                'default_value' => 'About',
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
            ],
        ]
    ];
}
