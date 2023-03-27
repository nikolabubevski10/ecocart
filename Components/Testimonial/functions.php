<?php

namespace Flynt\Components\Testimonial;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-testimonial',
            'title'             => __('Testimonial'),
            'description'       => __('Testimonial Section'),
            'render_callback'   => 'Flynt\Components\Testimonial\testimonialFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'testimonial'],
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

function testimonialFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/Testimonial/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $title = get_field('title');
        $list = get_field('list');
        $dot_desktop = Asset::requireUrl('Components/Testimonial/Assets/dot-desktop.svg');
        $dot_mobile = Asset::requireUrl('Components/Testimonial/Assets/dot-mobile.svg');
        $custom_padding_top = get_field('custom_padding_top');
        $custom_padding_bottom = get_field('custom_padding_bottom');
        $has_dot_image = get_field('has_dot_image');

        Timber::render('index.twig', [
            'title' => $title,
            'list' => $list,
            'dot_desktop' => $dot_desktop,
            'dot_mobile' => $dot_mobile,
            'custom_padding_top' => $custom_padding_top,
            'custom_padding_bottom' => $custom_padding_bottom,
            'has_dot_image' => $has_dot_image,
        ]);
    }
}
