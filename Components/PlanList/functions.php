<?php

namespace Flynt\Components\PlanList;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-plan-list',
            'title'             => __('Plan List'),
            'description'       => __('Plan List Section'),
            'render_callback'   => 'Flynt\Components\PlanList\planListFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'plan', 'list'],
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

function planListFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/PlanList/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $pre_title = get_field('pre_title');
        $plan_list = get_field('plan_list');
        $bottom_text = get_field('bottom_text');

        Timber::render('index.twig', [
            'pre_title' => $pre_title,
            'plan_list' => $plan_list,
            'bottom_text' => $bottom_text
        ]);
    }
}
