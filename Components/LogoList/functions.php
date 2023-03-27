<?php

namespace Flynt\Components\LogoList;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-logo-list',
            'title'             => __('Logo List'),
            'description'       => __('Logo List Section'),
            'render_callback'   => 'Flynt\Components\LogoList\logoListFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'logo', 'list'],
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

function logoListFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/LogoList/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $logo_list = get_field('logo_list');
        $title = get_field('title');

        Timber::render('index.twig', [
            'logo_list' => $logo_list,
            'title' => $title
        ]);
    }
}
