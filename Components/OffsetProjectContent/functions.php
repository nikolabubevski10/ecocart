<?php

namespace Flynt\Components\OffsetProjectContent;

use Timber;
use Flynt\Utils\Asset;

add_filter('Flynt/addComponentData?name=OffsetProjectContent', function ($data) {
    $data['dot_desktop'] = Asset::requireUrl('Components/OffsetProjectContent/Assets/dot-desktop.svg');

    $data['project_type'] = $data['post']->terms('project-type')[0];

    // $data['project_type_terms'] = Timber::get_terms([
    //     'taxonomy' => 'project-type',
    //     'hide_empty' => false,
    // ]);

    $google_map_point = $data['post']->meta('google_map_point');
    
    $data['lat'] = $google_map_point['lat'];
    $data['lng'] = $google_map_point['lng'];

    $data['goal_title'] = 'UN SUSTAINABLE DEVELOPMENT GOALS';
    $data['goals'] = $data['post']->terms('goal');
    $data['verifications'] = $data['post']->terms('verification');

    $data['impact_icons'] = [
        'earth' => Asset::requireUrl('Components/OffsetProjectContent/Assets/impact/earth.svg'),
        'tree' => Asset::requireUrl('Components/OffsetProjectContent/Assets/impact/tree.svg'),
        'water' => Asset::requireUrl('Components/OffsetProjectContent/Assets/impact/water.svg'),
        'car' => Asset::requireUrl('Components/OffsetProjectContent/Assets/impact/car.svg'),
        'wind-turbine' => Asset::requireUrl('Components/OffsetProjectContent/Assets/impact/windfarm.svg'),
        // 'home' => 'none',
        'bear' => Asset::requireUrl('Components/OffsetProjectContent/Assets/impact/bear.svg'),
        'stove' => Asset::requireUrl('Components/OffsetProjectContent/Assets/impact/stove.svg'),
        'biodigester' => Asset::requireUrl('Components/OffsetProjectContent/Assets/impact/biodgesters.svg'),
    ];

    return $data;
});
