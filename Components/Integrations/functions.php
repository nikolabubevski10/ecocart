<?php

namespace Flynt\Components\Integrations;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-integrations',
            'title'             => __('Integrations'),
            'description'       => __('Integrations Section'),
            'render_callback'   => 'Flynt\Components\Integrations\integrationsFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'industry'],
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

function integrationsFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/Integrations/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $title = get_field('title');
        $content = get_field('content');
        $top_dot_desktop = Asset::requireUrl('Components/Integrations/Assets/top-dot-desktop.svg');
        $bottom_dot_desktop = Asset::requireUrl('Components/Integrations/Assets/bottom-dot-desktop.svg');
        $top_dot_mobile = Asset::requireUrl('Components/Integrations/Assets/top-dot-mobile.svg');
        $bottom_dot_mobile = Asset::requireUrl('Components/Integrations/Assets/bottom-dot-mobile.svg');
        $integration_list = get_field('integration_list');

        Timber::render('index.twig', [
            'title' => $title,
            'content' => $content,
            'top_dot_desktop' => $top_dot_desktop,
            'bottom_dot_desktop' => $bottom_dot_desktop,
            'top_dot_mobile' => $top_dot_mobile,
            'bottom_dot_mobile' => $bottom_dot_mobile,
            'integration_list' => $integration_list,
        ]);
    }
}
