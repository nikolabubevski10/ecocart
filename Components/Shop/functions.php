<?php

namespace Flynt\Components\Shop;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-shop',
            'title'             => __('Shop'),
            'description'       => __('Shop Section'),
            'render_callback'   => 'Flynt\Components\Shop\shopFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'shop'],
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

function shopFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/Shop/Assets/example.png');
        
        echo '<img src="' . $screenshot . '" />';
    } else {
        $pre_title = get_field('pre_title');
        $title = get_field('title');
        $video = get_field('video');
        $list = get_field('list');
        $dot = Asset::requireUrl('Components/Shop/Assets/shop-dot.svg');
        $dot_mobile = Asset::requireUrl('Components/Shop/Assets/dot-mobile.svg');

        Timber::render('index.twig', [
            'pre_title' => $pre_title,
            'title' => $title,
            'video' => $video,
            'list' => $list,
            'dot' => $dot,
            'dot_mobile' => $dot_mobile,
        ]);
    }
}
