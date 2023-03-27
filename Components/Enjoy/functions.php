<?php

namespace Flynt\Components\Enjoy;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-enjoy',
            'title'             => __('Enjoy'),
            'description'       => __('Enjoy Section'),
            'render_callback'   => 'Flynt\Components\Enjoy\enjoyFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'enjoy'],
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

function enjoyFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/Enjoy/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $animation = get_field('animation');
        $pre_title = get_field('pre_title');
        $image_1 = get_field('image_1');
        $title_1 = get_field('title_1');
        $content_1 = get_field('content_1');
        $image_2 = get_field('image_2');
        $title_2 = get_field('title_2');
        $content_2 = get_field('content_2');
        $image_3 = get_field('image_3');
        $title_3 = get_field('title_3');
        $content_3 = get_field('content_3');
        $dot_desktop = Asset::requireUrl('Components/Enjoy/Assets/dot-desktop.svg');

        $animation_list = [
            'partners' => [
                '/Components/Enjoy/Assets/partners/revenue-share.json',
                '/Components/Enjoy/Assets/partners/partner-training.json',
                '/Components/Enjoy/Assets/partners/technical-support.json',
            ],
            'for-shoppers' => [
                '/Components/Enjoy/Assets/for-shoppers/we-don-t-sell.json',
                '/Components/Enjoy/Assets/for-shoppers/rewards-you-ll-love.json',
                '/Components/Enjoy/Assets/for-shoppers/you-re-in-control.json',
            ],
        ];

        Timber::render('index.twig', [
            'animation' => $animation,
            'animation_list' => $animation_list,
            'pre_title' => $pre_title,
            'image_1' => $image_1,
            'title_1' => $title_1,
            'content_1' => $content_1,
            'image_2' => $image_2,
            'title_2' => $title_2,
            'content_2' => $content_2,
            'image_3' => $image_3,
            'title_3' => $title_3,
            'content_3' => $content_3,
            'dot_desktop' => $dot_desktop,
        ]);
    }
}
