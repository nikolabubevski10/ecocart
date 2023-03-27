<?php

namespace Flynt\Components\Press;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-press',
            'title'             => __('Press'),
            'description'       => __('Press Section'),
            'render_callback'   => 'Flynt\Components\Press\pressFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'plan', 'list'],
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

function pressFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/Press/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $pre_title = get_field('pre_title');
        $top_logo = get_field('top_logo');
        $top_title = get_field('top_title');
        $top_authour = get_field('top_authour');
        $top_image = get_field('top_image');
        $top_link = get_field('top_link');
        $post_list = get_field('post_list');

        Timber::render('index.twig', [
            'pre_title' => $pre_title,
            'top_logo' => $top_logo,
            'top_title' => $top_title,
            'top_authour' => $top_authour,
            'top_image' => $top_image,
            'top_link' => $top_link,
            'post_list' => $post_list
        ]);
    }
}
