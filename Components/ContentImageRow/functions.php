<?php

namespace Flynt\Components\ContentImageRow;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-content-image-row',
            'title'             => __('Content Image Row'),
            'description'       => __('Content Image Row Section'),
            'render_callback'   => 'Flynt\Components\ContentImageRow\contentImageRowFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'content', 'image', 'row'],
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

function contentImageRowFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/ContentImageRow/Assets/example.png');
        
        echo '<img src="' . $screenshot . '" />';
    } else {
        $title = get_field('title');
        $content = get_field('content');
        $image = get_field('image');
        $animation = get_field('animation');
        $dot = Asset::requireUrl('Components/ContentImageRow/Assets/dot.svg');
        $dot_mobile = Asset::requireUrl('Components/ContentImageRow/Assets/dot-mobile.svg');
        $animation_list = [
            '/Components/ContentImageRow/Assets/carbon-offsetting.json',
        ];

        Timber::render('index.twig', [
            'title' => $title,
            'content' => $content,
            'image' => $image,
            'animation' => $animation,
            'animation_list' => $animation_list,
            'dot' => $dot,
            'dot_mobile' => $dot_mobile,
        ]);
    }
}
