<?php

namespace Flynt\Components\FAQ;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-faq',
            'title'             => __('FAQ'),
            'description'       => __('FAQ Section'),
            'render_callback'   => 'Flynt\Components\FAQ\fAQFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'faq'],
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

function fAQFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/FAQ/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $pre_title = get_field('pre_title');
        $faq_list = get_field('faq_list');
        $background_color = get_field('background_color');
        $has_dot_background = get_field('has_dot_background');
        $dot = Asset::requireUrl('Components/FAQ/Assets/faq-dot.svg');

        Timber::render('index.twig', [
            'pre_title' => $pre_title,
            'faq_list' => $faq_list,
            'background_color' => $background_color,
            'dot' => $dot,
            'has_dot_background' => $has_dot_background,
        ]);
    }
}
