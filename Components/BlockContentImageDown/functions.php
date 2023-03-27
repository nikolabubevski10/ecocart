<?php

namespace Flynt\Components\BlockContentImageDown;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-block-content-image-down',
            'title'             => __('Block Content Image Down'),
            'description'       => __('Block Content Image Down Section'),
            'render_callback'   => 'Flynt\Components\BlockContentImageDown\blockContentImageDownFunc',
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

function blockContentImageDownFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/BlockContentImageDown/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $dark_mode = get_field('dark_mode');
        $pre_title = get_field('pre_title');
        $title = get_field('title');
        $content = get_field('content');
        $link = get_field('link');
        $image = get_field('image');
        $image_mobile = get_field('image_mobile');
        $has_dot_image = get_field('has_dot_image');
        $animation = get_field('animation');
        $dot_image_desktop = Asset::requireUrl('Components/BlockContentImageDown/Assets/dot-desktop.svg');
        $dot_image_mobile = Asset::requireUrl('Components/BlockContentImageDown/Assets/dot-mobile.svg');

        $animation_list = [
            'offsetting-incentivizes-mitigation' => '/Components/BlockContentImageDown/Assets/types-of-emissions.json',
            'ecocart-project-network' => '/Components/BlockContentImageDown/Assets/ecocart-project-network.json'
        ];

        Timber::render('index.twig', [
            'dark_mode' => $dark_mode,
            'pre_title' => $pre_title,
            'title' => $title,
            'content' => $content,
            'link' => $link,
            'image' => $image,
            'image_mobile' => $image_mobile,
            'has_dot_image' => $has_dot_image,
            'animation' => $animation,
            'animation_list' => $animation_list,
            'dot_image_desktop' => $dot_image_desktop,
            'dot_image_mobile' => $dot_image_mobile,
        ]);
    }
}
