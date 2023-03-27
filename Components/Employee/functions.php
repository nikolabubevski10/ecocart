<?php

namespace Flynt\Components\Employee;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-employee',
            'title'             => __('Employee'),
            'description'       => __('Employee Section'),
            'render_callback'   => 'Flynt\Components\Employee\employeeFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'employee'],
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

function employeeFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/Employee/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $left_title = get_field('left_title');
        $left_logo_list = get_field('left_logo_list');
        $right_title = get_field('right_title');
        $right_logo_list = get_field('right_logo_list');
        $dot_desktop = Asset::requireUrl('Components/Employee/Assets/dot-desktop.svg');
        $dot_mobile = Asset::requireUrl('Components/Employee/Assets/dot-mobile.svg');

        Timber::render('index.twig', [
            'left_title' => $left_title,
            'left_logo_list' => $left_logo_list,
            'right_title' => $right_title,
            'right_logo_list' => $right_logo_list,
            'dot_desktop' => $dot_desktop,
            'dot_mobile' => $dot_mobile,
        ]);
    }
}
