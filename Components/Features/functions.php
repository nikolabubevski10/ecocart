<?php

namespace Flynt\Components\Features;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-features',
            'title'             => __('Features'),
            'description'       => __('Features Section'),
            'render_callback'   => 'Flynt\Components\Features\featuresFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'features'],
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

function featuresFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/Features/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $title = get_field('title');
        $list = get_field('list');
        $title_2 = get_field('title_2');
        $list_2 = get_field('list_2');
        $section_small_padding = get_field('section_small_padding');
        $has_left_dot_background = get_field('has_left_dot_background');
        $has_right_dot_background = get_field('has_right_dot_background');
        $animation_setting = get_field('animation_setting');
        $left_dot_desktop = Asset::requireUrl('Components/Features/Assets/featured-left-dot-desktop.svg');
        $right_dot_desktop = Asset::requireUrl('Components/Features/Assets/featured-right-dot-desktop.svg');
        $right_dot_mobile = Asset::requireUrl('Components/Features/Assets/featured-right-dot-mobile.svg');

        $animation_list = [
            'homepage' => [
                '/Components/Features/Assets/homepage/carbon-neutral.json',
                '/Components/Features/Assets/homepage/sustainability-led.json',
                '/Components/Features/Assets/homepage/in-depth-sustainability.json',
                '/Components/Features/Assets/homepage/sustainability-project-network.json'
            ],
            'apparel' => [
                '/Components/Features/Assets/homepage/carbon-neutral.json',
                '/Components/Features/Assets/homepage/sustainability-led.json',
                '/Components/Features/Assets/homepage/in-depth-sustainability.json',
                '/Components/Features/Assets/apparel/become-carbon.json',
            ],
            'cosmetics' => [
                '/Components/Features/Assets/homepage/carbon-neutral.json',
                '/Components/Features/Assets/homepage/sustainability-led.json',
                '/Components/Features/Assets/homepage/in-depth-sustainability.json',
                '/Components/Features/Assets/cosmetics/become-carbon.json',
            ],
            'homegoods' => [
                '/Components/Features/Assets/homepage/carbon-neutral.json',
                '/Components/Features/Assets/homepage/sustainability-led.json',
                '/Components/Features/Assets/homepage/in-depth-sustainability.json',
                '/Components/Features/Assets/homegoods/become-carbon.json',
            ],
            'consumer' => [
                '/Components/Features/Assets/homepage/carbon-neutral.json',
                '/Components/Features/Assets/homepage/sustainability-led.json',
                '/Components/Features/Assets/homepage/in-depth-sustainability.json',
                '/Components/Features/Assets/consumer/become-carbon.json',
            ]
        ];

        Timber::render('index.twig', [
            'title' => $title,
            'list' => $list,
            'title_2' => $title_2,
            'list_2' => $list_2,
            'section_small_padding' => $section_small_padding,
            'has_left_dot_background' => $has_left_dot_background,
            'has_right_dot_background' => $has_right_dot_background,
            'left_dot_desktop' => $left_dot_desktop,
            'right_dot_desktop' => $right_dot_desktop,
            'right_dot_mobile' => $right_dot_mobile,
            'animation_setting' => $animation_setting,
            'animation_list' => $animation_list[$animation_setting]
        ]);
    }
}
