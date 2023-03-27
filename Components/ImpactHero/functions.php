<?php

namespace Flynt\Components\ImpactHero;

use Timber\Timber;
use Timber\PostQuery;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-impact-hero',
            'title'             => __('Impact Hero'),
            'description'       => __('Impact Hero Section'),
            'render_callback'   => 'Flynt\Components\ImpactHero\impactHeroFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'impact', 'hero'],
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

function impactHeroFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/ImpactHero/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $title = get_field('title');
        $content = get_field('content');
        $link = get_field('link');

        $args = [
            'post_type' => 'offset-project',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'orderby' => 'date',
            'orderby' => 'DESC',
            'offset' => 0
        ];

        $project_list = new PostQuery($args);

        Timber::render('index.twig', [
            'title' => $title,
            'content' => $content,
            'link' => $link,
            'project_list' => $project_list,
        ]);
    }
}
