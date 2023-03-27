<?php

namespace Flynt\Components\WeDo;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-we-do',
            'title'             => __('We Do'),
            'description'       => __('We Do Section'),
            'render_callback'   => 'Flynt\Components\WeDo\weDoFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'we', 'do'],
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

function weDoFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/WeDo/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $title = get_field('title');
        $list = get_field('list');
        $animation = get_field('animation');
        $dot_1 = Asset::requireUrl('Components/WeDo/Assets/we-dot-1.svg');
        $dot_2 = Asset::requireUrl('Components/WeDo/Assets/we-dot-2.svg');
        $dot_mobile_top = Asset::requireUrl('Components/WeDo/Assets/dot-mobile-top.svg');
        $dot_mobile_bottom = Asset::requireUrl('Components/WeDo/Assets/dot-mobile-bottom.svg');
        $animation_list = [
            'we-do' => [
                '/Components/WeDo/Assets/we-do/reduce.json',
                '/Components/WeDo/Assets/we-do/track.json',
                '/Components/WeDo/Assets/we-do/share.json',
                '/Components/WeDo/Assets/we-do/leverage.json',
            ],
            'checkout' => [
                '/Components/WeDo/Assets/checkout/engage.json',
                '/Components/WeDo/Assets/checkout/educate.json',
                '/Components/WeDo/Assets/checkout/convert.json',
                '/Components/WeDo/Assets/checkout/offset.json',
            ],
        ];

        Timber::render('index.twig', [
            'title' => $title,
            'list' => $list,
            'animation' => $animation,
            'animation_list' => $animation_list,
            'dot_1' => $dot_1,
            'dot_2' => $dot_2,
            'dot_mobile_top' => $dot_mobile_top,
            'dot_mobile_bottom' => $dot_mobile_bottom,
        ]);
    }
}
