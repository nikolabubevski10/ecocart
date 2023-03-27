<?php

namespace Flynt\Components\BenefitInfo;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-benefit-info',
            'title'             => __('Benefit Info'),
            'description'       => __('Benefit Info Section'),
            'render_callback'   => 'Flynt\Components\BenefitInfo\benefitInfoFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'benefit'],
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

function benefitInfoFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/BenefitInfo/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $pre_title = get_field('pre_title');
        $title = get_field('title');
        $content = get_field('content');
        $dot_desktop = Asset::requireUrl('Components/BenefitInfo/Assets/dot-desktop.svg');
        $dot_mobile = Asset::requireUrl('Components/BenefitInfo/Assets/dot-mobile.svg');
        $image_1 = get_field('image_1');
        $image_2 = get_field('image_2');
        $image_3 = get_field('image_3');
        $popup_1 = get_field('popup_1');
        $popup_2 = get_field('popup_2');
        $popup_3 = get_field('popup_3');

        Timber::render('index.twig', [
            'pre_title' => $pre_title,
            'title' => $title,
            'content' => $content,
            'image' => $image,
            'dot_desktop' => $dot_desktop,
            'dot_mobile' => $dot_mobile,
            'image_1' => $image_1,
            'image_2' => $image_2,
            'image_3' => $image_3,
            'popup_1' => $popup_1,
            'popup_2' => $popup_2,
            'popup_3' => $popup_3,
        ]);
    }
}
