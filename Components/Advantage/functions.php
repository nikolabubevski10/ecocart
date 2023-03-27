<?php

namespace Flynt\Components\Advantage;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-advantage',
            'title'             => __('Advantage'),
            'description'       => __('Advantage Section'),
            'render_callback'   => 'Flynt\Components\Advantage\advantageFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'advantage'],
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

function advantageFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/Advantage/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $dot_desktop = Asset::requireUrl('Components/Advantage/Assets/dot-desktop.svg');
        $dot_mobile = Asset::requireUrl('Components/Advantage/Assets/dot-mobile.svg');
        $has_dot_background = get_field('has_dot_background');
        $background_color = get_field('background_color');
        $title_position = get_field('title_position');
        $title = get_field('title');
        $value_1 = get_field('value_1');
        $sub_title_1 = get_field('sub_title_1');
        $sub_content_1 = get_field('sub_content_1');
        $value_2 = get_field('value_2');
        $sub_title_2 = get_field('sub_title_2');
        $sub_content_2 = get_field('sub_content_2');
        $value_3 = get_field('value_3');
        $sub_title_3 = get_field('sub_title_3');
        $sub_content_3 = get_field('sub_content_3');

        Timber::render('index.twig', [
            'dot_desktop' => $dot_desktop,
            'dot_mobile' => $dot_mobile,
            'has_dot_background' => $has_dot_background,
            'background_color' => $background_color,
            'title_position' => $title_position,
            'title' => $title,
            'value_1' => $value_1,
            'sub_title_1' => $sub_title_1,
            'sub_content_1' => $sub_content_1,
            'value_2' => $value_2,
            'sub_title_2' => $sub_title_2,
            'sub_content_2' => $sub_content_2,
            'value_3' => $value_3,
            'sub_title_3' => $sub_title_3,
            'sub_content_3' => $sub_content_3,
        ]);
    }
}
