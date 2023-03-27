<?php

namespace Flynt\Components\VerticalsHero;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-verticals-hero',
            'title'             => __('Verticals Hero'),
            'description'       => __('Verticals Hero Section'),
            'render_callback'   => 'Flynt\Components\VerticalsHero\verticalsHeroFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'verticals', 'hero'],
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

function verticalsHeroFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/VerticalsHero/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $title = get_field('title');
        $content = get_field('content');
        $link = get_field('link');
        $image = get_field('image');
        $mobile_image = get_field('mobile_image');
        $custom_title_width = get_field('custom_title_width');
        $custom_content_width = get_field('custom_content_width');
        $content_dot = get_field('content_dot');
        $has_down_button = get_field('has_down_button');
        $has_animation = get_field('has_animation');
        $animation = get_field('animation');
        $link_jump_section_id = get_field('link_jump_section_id');
        $dot_desktop = Asset::requireUrl('Components/VerticalsHero/Assets/dot-desktop.svg');
        $dot_mobile = Asset::requireUrl('Components/VerticalsHero/Assets/dot-mobile.svg');
        $animation_list = [
            'a-360-view' => '/Components/VerticalsHero/Assets/a-360-view.json',
            'become-carbon-neutral' => '/Components/VerticalsHero/Assets/become-carbon-neutral.json',
            'for-shoppers' => '/Components/VerticalsHero/Assets/sustainable-shopping.json',
        ];

        Timber::render('index.twig', [
            'title' => $title,
            'content' => $content,
            'link' => $link,
            'image' => $image,
            'mobile_image' => $mobile_image,
            'custom_title_width' => $custom_title_width,
            'custom_content_width' => $custom_content_width,
            'content_dot' => $content_dot,
            'has_down_button' => $has_down_button,
            'has_animation' => $has_animation,
            'animation' => $animation,
            'animation_list' => $animation_list,
            'dot_desktop' => $dot_desktop,
            'dot_mobile' => $dot_mobile,
            'link_jump_section_id' => $link_jump_section_id,
        ]);
    }
}
