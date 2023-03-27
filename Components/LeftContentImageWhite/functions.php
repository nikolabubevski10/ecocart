<?php

namespace Flynt\Components\LeftContentImageWhite;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-left-content-image-white',
            'title'             => __('Left Content Image White'),
            'description'       => __('Left Content Image White Section'),
            'render_callback'   => 'Flynt\Components\LeftContentImageWhite\blockContentLeftImage',
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

function blockContentLeftImage($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/LeftContentImageWhite/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $pre_title = get_field('pre_title');
        $title = get_field('title');
        $content = get_field('content');
        $image_1 = get_field('image_1');
        $image_2 = get_field('image_2');
        $image_3 = get_field('image_3');
        $image_4 = get_field('image_4');
        $image_5 = get_field('image_5');
        $dot_desktop = Asset::requireUrl('Components/LeftContentImageWhite/Assets/left-content-image-white-dot.svg');
        $dot_mobile = Asset::requireUrl('Components/LeftContentImageWhite/Assets/dot-mobile.svg');

        Timber::render('index.twig', [
            'pre_title' => $pre_title,
            'title' => $title,
            'content' => $content,
            'image_1' => $image_1,
            'image_2' => $image_2,
            'image_3' => $image_3,
            'image_4' => $image_4,
            'image_5' => $image_5,
            'dot_desktop' => $dot_desktop,
            'dot_mobile' => $dot_mobile,
        ]);
    }
}
