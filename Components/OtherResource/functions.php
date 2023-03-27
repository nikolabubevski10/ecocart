<?php

namespace Flynt\Components\OtherResource;

use Timber\Timber;
use Flynt\Utils\Asset;

function getResourceList($excerpt_post)
{
    $args = [
        'post_type' => 'post',
        'posts_per_page' => 3,
        'post_status' => 'publish',
        'orderby' => 'rand',
    ];

    if (!empty($excerpt_post)) {
        $args['post__not_in'] = [$excerpt_post->ID];
    }
    
    return Timber::get_posts($args);
}

add_filter('Flynt/addComponentData?name=OtherResource', function ($data) {
    $data['dot'] = [
        'src' => Asset::requireUrl('Components/OtherResource/Assets/other-resource-dot.svg'),
        'alt' => 'dot'
    ];

    $data['resourceList'] = getResourceList($data['excerpt_post']);
    $data['dot_mobile'] = Asset::requireUrl('Components/OtherResource/Assets/dot-mobile.svg');

    return $data;
});

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-other-resource',
            'title'             => __('Other Resource'),
            'description'       => __('Other Resource Section'),
            'render_callback'   => 'Flynt\Components\OtherResource\otherResourceFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'resource'],
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

function otherResourceFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/OtherResource/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $excerpt_post = get_field('excerpt_post');

        $dot = [
            'src' => Asset::requireUrl('Components/OtherResource/Assets/other-resource-dot.svg'),
            'alt' => 'dot'
        ];
        
        Timber::render('index.twig', [
            'resourceList' => getResourceList($excerpt_post),
            'dot' => $dot,
            'dot_mobile' => Asset::requireUrl('Components/OtherResource/Assets/dot-mobile.svg'),
        ]);
    }
}
