<?php

namespace Flynt\Components\BlockContentImage;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-block-content-image',
            'title'             => __('Block Content Image'),
            'description'       => __('Block Content Image Section'),
            'render_callback'   => 'Flynt\Components\BlockContentImage\blockContentImageFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'content'],
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

function blockContentImageFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/BlockContentImage/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $pre_title_1 = get_field('pre_title_1');
        $title_1 = get_field('title_1');
        $content_1 = get_field('content_1');
        $image_1 = get_field('image_1');
        $pre_title_2 = get_field('pre_title_2');
        $title_2 = get_field('title_2');
        $content_2 = get_field('content_2');
        $link_1 = get_field('link_1');
        $image_2 = get_field('image_2');
        $title_3 = get_field('title_3');
        $content_3 = get_field('content_3');
        $link_2 = get_field('link_2');
        $image_3 = get_field('image_3');
        $animation = get_field('animation');
        $dot_1_desktop = Asset::requireUrl('Components/BlockContentImage/Assets/dot-1-desktop.svg');
        $dot_2_desktop = Asset::requireUrl('Components/BlockContentImage/Assets/dot-2-desktop.svg');
        $dot_mobile = Asset::requireUrl('Components/BlockContentImage/Assets/dot-mobile.svg');
        $animation_list = [
            '/Components/BlockContentImage/Assets/carbon-offsetting/how-do-carbon-offsets-work.json',
            '/Components/BlockContentImage/Assets/carbon-offsetting/offsetting-incentivizes-mitigation.json',
            '/Components/BlockContentImage/Assets/carbon-offsetting/mitigation-is-not-enough.json',
        ];

        Timber::render('index.twig', [
            'animation' => $animation,
            'animation_list' => $animation_list,
            'pre_title_1' => $pre_title_1,
            'title_1' => $title_1,
            'content_1' => $content_1,
            'image_1' => $image_1,
            'pre_title_2' => $pre_title_2,
            'title_2' => $title_2,
            'content_2' => $content_2,
            'link_1' => $link_1,
            'image_2' => $image_2,
            'title_3' => $title_3,
            'content_3' => $content_3,
            'link_2' => $link_2,
            'image_3' => $image_3,
            'dot_1_desktop' => $dot_1_desktop,
            'dot_2_desktop' => $dot_2_desktop,
            'dot_mobile' => $dot_mobile,
        ]);
    }
}
