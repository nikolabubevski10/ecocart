<?php

namespace Flynt\Components\Solution;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-solution',
            'title'             => __('Solution'),
            'description'       => __('Solution Section'),
            'render_callback'   => 'Flynt\Components\Solution\solutionFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'solution'],
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

function solutionFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/Solution/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $pre_title = get_field('pre_title');
        $content = get_field('content');
        $solution_list = get_field('solution_list');

        Timber::render('index.twig', [
            'pre_title' => $pre_title,
            'content' => $content,
            'solution_list' => $solution_list,
        ]);
    }
}

function getACFLayout()
{
    return [
        'name' => 'solution',
        'label' => 'Solution',
        'sub_fields' => [
            [
                'label' => 'Pre Title',
                'name' => 'pre_title',
                'type' => 'text',
                'default_value' => 'Solution',
            ],
            [
                'label' => 'Content',
                'name' => 'content',
                'type' => 'textarea',
            ],
            [
                'label' => 'Solution List',
                'name' => 'solution_list',
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
                    ]
                ]
            ]
        ]
    ];
}
