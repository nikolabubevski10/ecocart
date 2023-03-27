<?php

namespace Flynt\Components\Block4ColText;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-block-4-col-text',
            'title'             => __('Block 4 Col Text'),
            'description'       => __('Block 4 Col Text Section'),
            'render_callback'   => 'Flynt\Components\Block4ColText\block4ColTextFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'text'],
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

function block4ColTextFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/Block4ColText/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $pre_title = get_field('pre_title');
        $title = get_field('title');
        $animation = get_field('animation');
        $icon_1 = get_field('icon_1');
        $title_1 = get_field('title_1');
        $content_1 = get_field('content_1');
        $icon_2 = get_field('icon_2');
        $title_2 = get_field('title_2');
        $content_2 = get_field('content_2');
        $icon_3 = get_field('icon_3');
        $title_3 = get_field('title_3');
        $content_3 = get_field('content_3');
        $icon_4 = get_field('icon_4');
        $title_4 = get_field('title_4');
        $content_4 = get_field('content_4');
        $animation_list = [
            '/Components/Block4ColText/Assets/impact/legitimacy.json',
            '/Components/Block4ColText/Assets/impact/impact.json',
            '/Components/Block4ColText/Assets/impact/traceability.json',
            '/Components/Block4ColText/Assets/impact/transparency.json',
        ];

        Timber::render('index.twig', [
            'pre_title' => $pre_title,
            'title' => $title,
            'animation' => $animation,
            'animation_list' => $animation_list,
            'icon_1' => $icon_1,
            'title_1' => $title_1,
            'content_1' => $content_1,
            'icon_2' => $icon_2,
            'title_2' => $title_2,
            'content_2' => $content_2,
            'icon_3' => $icon_3,
            'title_3' => $title_3,
            'content_3' => $content_3,
            'icon_4' => $icon_4,
            'title_4' => $title_4,
            'content_4' => $content_4,
        ]);
    }
}
