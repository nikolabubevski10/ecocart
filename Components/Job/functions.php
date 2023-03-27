<?php

namespace Flynt\Components\Job;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-job',
            'title'             => __('Job'),
            'description'       => __('Job Section'),
            'render_callback'   => 'Flynt\Components\Job\jobFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'job'],
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

function jobFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/Job/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $section_id = get_field('section_id');
        $pre_title = get_field('pre_title');
        $job_list = get_field('job_list');

        Timber::render('index.twig', [
            'section_id' => $section_id,
            'pre_title' => $pre_title,
            'job_list' => $job_list,
        ]);
    }
}
