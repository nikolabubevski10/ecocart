<?php

namespace Flynt\Components\IntegrationHero;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-integration-hero',
            'title'             => __('Integration Hero'),
            'description'       => __('Integration Hero Section'),
            'render_callback'   => 'Flynt\Components\IntegrationHero\integrationHeroFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'integration', 'hero'],
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

function integrationHeroFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/IntegrationHero/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $title = get_field('title');
        $logo = get_field('logo');
        $content = get_field('content');
        $link = get_field('link');
        $image = get_field('image');
        $dot_desktop = Asset::requireUrl('Components/IntegrationHero/Assets/dot-desktop.svg');
        $dot_mobile = Asset::requireUrl('Components/IntegrationHero/Assets/dot-mobile.svg');

        Timber::render('index.twig', [
            'title' => $title,
            'logo' => $logo,
            'content' => $content,
            'link' => $link,
            'image' => $image,
            'dot_desktop' => $dot_desktop,
            'dot_mobile' => $dot_mobile,
        ]);
    }
}
