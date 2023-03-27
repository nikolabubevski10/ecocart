<?php

namespace Flynt\Components\ProjectList;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'ecocart-project-list',
            'title'             => __('Project List'),
            'description'       => __('Project List Section'),
            'render_callback'   => 'Flynt\Components\ProjectList\projectListFunc',
            'category'          => 'ecocart',
            'icon'              => 'admin-comments',
            'keywords'          => ['ecocart', 'project', 'list'],
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

function projectListFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/ProjectList/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $bottom_dot = Asset::requireUrl('Components/ProjectList/Assets/product-list-bottom-dot.svg');

        $projectTypeTerms = Timber::get_terms([
            'taxonomy' => 'project-type',
            'hide_empty' => false,
        ]);

        $args = [
            'post_type' => 'offset-project',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'orderby' => 'date',
            'orderby' => 'DESC',
        ];
        
        $offsetProjects = Timber::get_posts($args);

        Timber::render('index.twig', [
            'offsetProjects' => $offsetProjects,
            'bottom_dot' => $bottom_dot,
            'projectTypeTerms' => $projectTypeTerms,
        ]);
    }
}

add_action('wp_ajax_get_project_list', 'Flynt\Components\ProjectList\getProjectListFunc');
add_action('wp_ajax_nopriv_get_project_list', 'Flynt\Components\ProjectList\getProjectListFunc');

function getProjectListFunc()
{

    $result = [];
    $projectType = $_REQUEST['projectType'];
    $orderby = $_REQUEST['orderby'];

    $args = [
        'post_type' => 'offset-project',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'date',
        'orderby' => $orderby,
    ];

    if ($projectType !== '0') {
        $args['tax_query'] = [
            [
                'taxonomy' => 'project-type',
                'field' => 'slug',
                'terms' => $projectType
            ]
        ];
    }

    $project_list = Timber::get_posts($args);

    $result['project_list_html'] = Timber::compile('Partials/offset-project-list.twig', ['offsetProjects' => $project_list]);

    $featureList = [];

    foreach ($project_list as $project) {
        $featureList[] = [
            'type' => 'Feature',
            'geometry' => [
                'type' => 'Point',
                'coordinates' => [
                    $project->meta('google_map_point')['lng'],
                    $project->meta('google_map_point')['lat']
                ]
            ],
            'properties' => [
                'title' => $project->title,
                'link' => $project->link
            ]
        ];
    }

    $result['ecocartOffsetProjectList'] = [
        'type' => 'geojson',
        'data' => [
            'type' => 'FeatureCollection',
            'features' => $featureList
        ]
    ];

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $result = json_encode($result);
        echo $result;
    } else {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

    die();
}
