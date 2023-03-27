<?php

namespace Flynt\Components\VerticalsCTA;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-verticals-cta',
            'title'             => __('Verticals CTA'),
            'description'       => __('Verticals CTA Section'),
            'render_callback'   => 'Flynt\Components\VerticalsCTA\verticalsCTAFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'verticals', 'cta'],
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

function verticalsCTAFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/VerticalsCTA/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $title = get_field('title');
        $link = get_field('link');
        $image = get_field('image');
        $content = get_field('content');
        $has_dot_background = get_field('has_dot_background');
        $background_color = get_field('background_color');
        $dot_desktop = Asset::requireUrl('Components/VerticalsCTA/Assets/dot-desktop.svg');
        $dot_mobile = Asset::requireUrl('Components/VerticalsCTA/Assets/dot-mobile.svg');

        Timber::render('index.twig', [
            'title' => $title,
            'link' => $link,
            'image' => $image,
            'content' => $content,
            'has_dot_background' => $has_dot_background,
            'background_color' => $background_color,
            'dot_desktop' => $dot_desktop,
            'dot_mobile' => $dot_mobile,
        ]);
    }
}
