<?php

namespace Flynt\Components\HomepageHero;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-homepage-hero',
            'title'             => __('Homepage Hero'),
            'description'       => __('Homepage Hero Section'),
            'render_callback'   => 'Flynt\Components\HomepageHero\homepageHeroFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'homepage', 'hero'],
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

function homepageHeroFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/HomepageHero/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $title = get_field('title');
        $content = get_field('content');
        $link = get_field('link');
        $image = Asset::requireUrl('Components/HomepageHero/Assets/home-phone.svg');

        Timber::render('index.twig', [
            'title' => $title,
            'content' => $content,
            'link' => $link,
            'image' => $image,
        ]);
    }
}
