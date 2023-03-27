<?php

namespace Flynt\Components\PriceHero;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-price-hero',
            'title'             => __('Price Hero'),
            'description'       => __('Price Hero Section'),
            'render_callback'   => 'Flynt\Components\PriceHero\priceHeroFunc',
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

function priceHeroFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/PriceHero/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $title = get_field('title');
        $content = get_field('content');
        $logo_1 = get_field('logo_1');
        $title_1 = get_field('title_1');
        $content_1 = get_field('content_1');
        $link_1 = get_field('link_1');
        $logo_2 = get_field('logo_2');
        $title_2 = get_field('title_2');
        $content_2 = get_field('content_2');
        $link_2 = get_field('link_2');

        Timber::render('index.twig', [
            'title' => $title,
            'content' => $content,
            'logo_1' => $logo_1,
            'title_1' => $title_1,
            'content_1' => $content_1,
            'link_1' => $link_1,
            'logo_2' => $logo_2,
            'title_2' => $title_2,
            'content_2' => $content_2,
            'link_2' => $link_2,
        ]);
    }
}
