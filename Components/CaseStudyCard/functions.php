<?php

namespace Flynt\Components\CaseStudyCard;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-case-study-card',
            'title'             => __('Case Study Card'),
            'description'       => __('Case Study Card Section'),
            'render_callback'   => 'Flynt\Components\CaseStudyCard\caseStudyCardFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'carbon', 'hero'],
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

function caseStudyCardFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/CaseStudyCard/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $pre_title = get_field('pre_title');
        $image = get_field('image');
        $logo = get_field('logo');
        $title = get_field('title');
        $content = get_field('content');
        $avatar = get_field('avatar');
        $name = get_field('name');
        $role = get_field('role');
        $link = get_field('link');
        $kpi_lable_1 = get_field('kpi_lable_1');
        $kpi_lable_2 = get_field('kpi_lable_2');
        $link_position = get_field('link_position');
        $custom_padding_top = get_field('custom_padding_top');
        $custom_padding_bottom = get_field('custom_padding_bottom');
        $has_dot_background = get_field('has_dot_background');
        $dot_desktop = Asset::requireUrl('Components/CaseStudyCard/Assets/dot-desktop.svg');
        $dot_mobile = Asset::requireUrl('Components/CaseStudyCard/Assets/dot-mobile.svg');

        Timber::render('index.twig', [
            'pre_title' => $pre_title,
            'image' => $image,
            'logo' => $logo,
            'title' => $title,
            'content' => $content,
            'avatar' => $avatar,
            'name' => $name,
            'role' => $role,
            'link' => $link,
            'kpi_lable_1' => $kpi_lable_1,
            'kpi_lable_2' => $kpi_lable_2,
            'link_position' => $link_position,
            'custom_padding_top' => $custom_padding_top,
            'custom_padding_bottom' => $custom_padding_bottom,
            'dot_desktop' => $dot_desktop,
            'dot_mobile' => $dot_mobile,
            'has_dot_background' => $has_dot_background,
        ]);
    }
}
