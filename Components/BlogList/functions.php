<?php

namespace Flynt\Components\BlogList;

use Timber\Timber;
use Timber\PostQuery;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-blog-list',
            'title'             => __('Blog List'),
            'description'       => __('Blog List Section'),
            'render_callback'   => 'Flynt\Components\BlogList\blogListFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'blog', 'list'],
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

function blogListFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/BlogList/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $top_dot_desktop = Asset::requireUrl('Components/BlogList/Assets/top-dot-desktop.svg');
        $bottom_dot_desktop = Asset::requireUrl('Components/BlogList/Assets/bottom-dot-desktop.svg');
        $spin = Asset::requireUrl('Components/BlogList/Assets/ajax-spin.gif');

        $args = [
            'post_type' => 'post',
            'posts_per_page' => 10,
            'post_status' => 'publish',
            'orderby' => 'date',
            'orderby' => 'DESC',
            'offset' => 0
        ];

        $blog_list = new PostQuery($args);

        $category_terms = Timber::get_terms([
            'taxonomy' => 'category',
            'hide_empty' => false,
            'exclude' => 1,
        ]);

        Timber::render('index.twig', [
            'blog_list' => $blog_list,
            'top_dot_desktop' => $top_dot_desktop,
            'bottom_dot_desktop' => $bottom_dot_desktop,
            'spin' => $spin,
            'category_terms' => $category_terms,
            'total_blog_count' => $blog_list->found_posts,
            'current_blog_count' => count($blog_list),
            'current_cat_id' => 0,
        ]);
    }
}

add_filter('Flynt/addComponentData?name=BlogList', function ($data) {
    $data['top_dot_desktop'] = Asset::requireUrl('Components/BlogList/Assets/top-dot-desktop.svg');
    $data['bottom_dot_desktop'] = Asset::requireUrl('Components/BlogList/Assets/bottom-dot-desktop.svg');
    $data['spin'] = Asset::requireUrl('Components/BlogList/Assets/ajax-spin.gif');

    $args = [
        'post_type' => 'post',
        'posts_per_page' => 10,
        'post_status' => 'publish',
        'orderby' => 'date',
        'orderby' => 'DESC',
        'offset' => 0
    ];

    if (!empty($data['current_cat_id'])) {
        $args['cat'] = $data['current_cat_id'];
    }

    $data['blog_list'] = new PostQuery($args);
    $data['total_blog_count'] = $data['blog_list']->found_posts;
    $data['current_blog_count'] = count($data['blog_list']);

    $data['category_terms'] = Timber::get_terms([
        'taxonomy' => 'category',
        'hide_empty' => false,
        'exclude' => 1,
    ]);

    return $data;
});

add_action('wp_ajax_get_blog_list', 'Flynt\Components\BlogList\getBlogListFunc');
add_action('wp_ajax_nopriv_get_blog_list', 'Flynt\Components\BlogList\getBlogListFunc');

function getBlogListFunc()
{

    $result = [];
    $catID = intval($_REQUEST['catID']);
    $offset = intval($_REQUEST['offset']);

    $args = [
        'post_type' => 'post',
        'posts_per_page' => 10,
        'post_status' => 'publish',
        'orderby' => 'date',
        'orderby' => 'DESC',
        'cat' => $catID,
        'offset' => $offset
    ];

    $blog_list = new PostQuery($args);

    $result['blog_grid_html'] = Timber::compile('Partials/blog-grid.twig', ['blog_list' => $blog_list]);
    $result['total_blog_count'] = $blog_list->found_posts;
    $result['current_blog_count'] = count($blog_list);

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $result = json_encode($result);
        echo $result;
    } else {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

    die();
}

add_action('wp_ajax_get_blog_list_more', 'Flynt\Components\BlogList\getBlogListMoreFunc');
add_action('wp_ajax_nopriv_get_blog_list_more', 'Flynt\Components\BlogList\getBlogListMoreFunc');

function getBlogListMoreFunc()
{

    $result = [];
    $catID = intval($_REQUEST['catID']);
    $offset = intval($_REQUEST['offset']);

    $args = [
        'post_type' => 'post',
        'posts_per_page' => 9,
        'post_status' => 'publish',
        'orderby' => 'date',
        'orderby' => 'DESC',
        'cat' => $catID,
        'offset' => $offset
    ];

    $blog_list = new PostQuery($args);

    $result['blog_grid_html'] = Timber::compile('Partials/blog-grid-more.twig', ['blog_list' => $blog_list]);
    $result['total_blog_count'] = $blog_list->found_posts;
    $result['current_blog_count'] = count($blog_list);

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $result = json_encode($result);
        echo $result;
    } else {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

    die();
}
