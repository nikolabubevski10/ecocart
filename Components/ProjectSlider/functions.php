<?php

namespace Flynt\Components\ProjectSlider;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-project-slider',
            'title'             => __('Project Slider'),
            'description'       => __('Project Slider Section'),
            'render_callback'   => 'Flynt\Components\ProjectSlider\projectSliderFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'slider'],
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

function projectSliderFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/ProjectSlider/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $pre_title = get_field('pre_title');
        $title = get_field('title');
        $link = get_field('link');
        $image_list = get_field('image_list');

        Timber::render('index.twig', [
            'pre_title' => $pre_title,
            'title' => $title,
            'link' => $link,
            'image_list' => $image_list,
        ]);
    }
}
