<?php

namespace Flynt\Components\ResourceInfo;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-resource-info',
            'title'             => __('Resource Info'),
            'description'       => __('Resource Info Section'),
            'render_callback'   => 'Flynt\Components\ResourceInfo\resourceInfoFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'resource'],
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

function resourceInfoFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/ResourceInfo/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $pre_title = get_field('pre_title');
        $image = get_field('image');
        $pre_title_1 = get_field('pre_title_1');
        $title_1 = get_field('title_1');
        $content_1 = get_field('content_1');
        $link_1 = get_field('link_1');
        $pre_title_2 = get_field('pre_title_2');
        $title_2 = get_field('title_2');
        $content_2 = get_field('content_2');
        $link_2 = get_field('link_2');
        $pre_title_3 = get_field('pre_title_3');
        $title_3 = get_field('title_3');
        $content_3 = get_field('content_3');
        $link_3 = get_field('link_3');
        $pre_title_4 = get_field('pre_title_4');
        $title_4 = get_field('title_4');
        $content_4 = get_field('content_4');
        $link_4 = get_field('link_4');
        $dot_desktop = Asset::requireUrl('Components/ResourceInfo/Assets/dot-desktop.svg');
        $dot_mobile = Asset::requireUrl('Components/ResourceInfo/Assets/dot-mobile.svg');

        Timber::render('index.twig', [
            'pre_title' => $pre_title,
            'image' => $image,
            'pre_title_1' => $pre_title_1,
            'title_1' => $title_1,
            'content_1' => $content_1,
            'link_1' => $link_1,
            'pre_title_2' => $pre_title_2,
            'title_2' => $title_2,
            'content_2' => $content_2,
            'link_2' => $link_2,
            'pre_title_3' => $pre_title_3,
            'title_3' => $title_3,
            'content_3' => $content_3,
            'link_3' => $link_3,
            'pre_title_4' => $pre_title_4,
            'title_4' => $title_4,
            'content_4' => $content_4,
            'link_4' => $link_4,
            'dot_desktop' => $dot_desktop,
            'dot_mobile' => $dot_mobile,
        ]);
    }
}
