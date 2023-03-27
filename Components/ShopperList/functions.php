<?php

namespace Flynt\Components\ShopperList;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-shopper-list',
            'title'             => __('Shopper List'),
            'description'       => __('Shopper List Section'),
            'render_callback'   => 'Flynt\Components\ShopperList\shopperListFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'shopper', 'list'],
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

function shopperListFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/ShopperList/Assets/example.png');
        
        echo '<img src="' . $screenshot . '" />';
    } else {
        $title = get_field('title');
        $list = get_field('list');
        $dot_desktop = Asset::requireUrl('Components/ShopperList/Assets/dot-desktop.svg');
        $dot_mobile = Asset::requireUrl('Components/ShopperList/Assets/dot-mobile.svg');

        Timber::render('index.twig', [
            'title' => $title,
            'list' => $list,
            'dot_desktop' => $dot_desktop,
            'dot_mobile' => $dot_mobile,
        ]);
    }
}
