<?php

namespace Flynt\Components\Story;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-story',
            'title'             => __('Story'),
            'description'       => __('Story Section'),
            'render_callback'   => 'Flynt\Components\Story\storyFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'story'],
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

function storyFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/Story/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $pre_title = get_field('pre_title');
        $left_title = get_field('left_title');
        $left_content = get_field('left_content');
        $link = get_field('link');
        $right_content = get_field('right_content');
        $avatar = get_field('avatar');
        $name = get_field('name');
        $role = get_field('role');

        Timber::render('index.twig', [
            'pre_title' => $pre_title,
            'left_title' => $left_title,
            'left_content' => $left_content,
            'link' => $link,
            'right_content' => $right_content,
            'avatar' => $avatar,
            'name' => $name,
            'role' => $role,
        ]);
    }
}
