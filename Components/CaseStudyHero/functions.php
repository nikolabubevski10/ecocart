<?php

namespace Flynt\Components\CaseStudyHero;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-case-study-hero',
            'title'             => __('Case Study Hero'),
            'description'       => __('Case Study Hero Section'),
            'render_callback'   => 'Flynt\Components\CaseStudyHero\caseStudyHeroFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'price', 'hero'],
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

function caseStudyHeroFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/CaseStudyHero/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $logo = get_field('logo');
        $title = get_field('title');
        $content = get_field('content');
        $link = get_field('link');
        $image = get_field('image');
        $dot_desktop = Asset::requireUrl('Components/CaseStudyHero/Assets/dot-desktop.svg');
        $dot_mobile = Asset::requireUrl('Components/CaseStudyHero/Assets/dot-mobile.svg');

        Timber::render('index.twig', [
            'logo' => $logo,
            'title' => $title,
            'content' => $content,
            'link' => $link,
            'image' => $image,
            'dot_desktop' => $dot_desktop,
            'dot_mobile' => $dot_mobile,
        ]);
    }
}

function getACFLayout()
{
    return [
        'name' => 'caseStudyHero',
        'label' => 'Case Study Hero',
        'sub_fields' => [
            [
                'label' => 'Logo',
                'name' => 'logo',
                'type' => 'image',
                'max_size' => 4,
            ],
            [
                'label' => 'Title',
                'name' => 'title',
                'type' => 'text',
            ],
            [
                'label' => 'Content',
                'name' => 'content',
                'type' => 'textarea',
                'rows' => 4,
            ],
            [
                'label' => 'Link',
                'name' => 'link',
                'type' => 'link',
            ],
            [
                'label' => 'Image',
                'name' => 'image',
                'type' => 'image',
            ],
        ]
    ];
}

add_filter('Flynt/addComponentData?name=CaseStudyHero', function ($data) {
    $data['dot_desktop'] = Asset::requireUrl('Components/CaseStudyHero/Assets/dot-desktop.svg');
    $data['dot_mobile'] = Asset::requireUrl('Components/CaseStudyHero/Assets/dot-mobile.svg');

    return $data;
});
