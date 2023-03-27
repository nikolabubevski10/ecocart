<?php

namespace Flynt\Components\Brand;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-brand',
            'title'             => __('Brand'),
            'description'       => __('Brand Section'),
            'render_callback'   => 'Flynt\Components\Brand\brandFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'brand'],
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

function brandFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/Brand/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $title = get_field('title');
        $content = get_field('content');
        $link = get_field('link');
        $image = get_field('image');
        $description = get_field('description');
        $dot_desktop = Asset::requireUrl('Components/Brand/Assets/dot-desktop.svg');
        $dot_mobile = Asset::requireUrl('Components/Brand/Assets/dot-mobile.svg');

        Timber::render('index.twig', [
            'title' => $title,
            'content' => $content,
            'link' => $link,
            'image' => $image,
            'description' => $description,
            'dot_desktop' => $dot_desktop,
            'dot_mobile' => $dot_mobile,
        ]);
    }
}
