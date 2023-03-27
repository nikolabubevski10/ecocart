<?php

namespace Flynt\Components\SolutionHero;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-solution-hero',
            'title'             => __('Solution Hero'),
            'description'       => __('Solution Hero Section'),
            'render_callback'   => 'Flynt\Components\SolutionHero\solutionHeroFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'solution', 'hero'],
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

function solutionHeroFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/SolutionHero/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $animation = get_field('animation');
        $title = get_field('title');
        $content = get_field('content');
        $link = get_field('link');
        $image = get_field('image');
        $dot_desktop = Asset::requireUrl('Components/SolutionHero/Assets/dot-desktop.svg');
        $dot_mobile = Asset::requireUrl('Components/SolutionHero/Assets/dot-mobile.svg');

        $animation_list = [
            'apparel' => '/Components/SolutionHero/Assets/apparel.json',
            'cosmetics' => '/Components/SolutionHero/Assets/cosmetics.json',
            'homegoods' => '/Components/SolutionHero/Assets/homegoods.json',
            'consumer' => '/Components/SolutionHero/Assets/consumer.json',
        ];

        Timber::render('index.twig', [
            'animation' => $animation,
            'animation_list' => $animation_list,
            'title' => $title,
            'content' => $content,
            'link' => $link,
            'image' => $image,
            'dot_desktop' => $dot_desktop,
            'dot_mobile' => $dot_mobile,
        ]);
    }
}
