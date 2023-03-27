<?php

namespace Flynt\Components\RequestDemo;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-request-demo',
            'title'             => __('Request Demo'),
            'description'       => __('Request Demo Section'),
            'render_callback'   => 'Flynt\Components\RequestDemo\requestDemoFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'request'],
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

function requestDemoFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/RequestDemo/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $hubspot_code = get_field('hubspot_code');
        $image = get_field('image');
        $title = get_field('title');
        $content = get_field('content');
        $dot_desktop = Asset::requireUrl('Components/RequestDemo/Assets/dot-desktop.svg');

        Timber::render('index.twig', [
            'hubspot_code' => $hubspot_code,
            'image' => $image,
            'title' => $title,
            'content' => $content,
            'dot_desktop' => $dot_desktop,
        ]);
    }
}
