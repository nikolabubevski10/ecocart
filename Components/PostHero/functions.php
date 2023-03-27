<?php

namespace Flynt\Components\PostHero;

use Flynt\Utils\Asset;

add_filter('Flynt/addComponentData?name=PostHero', function ($data) {
    $data['dot'] = [
        'src' => Asset::requireUrl('Components/PostHero/Assets/post-hero-dot.svg'),
        'alt' => 'dot'
    ];

    $data['dot_mobile'] = [
        'src' => Asset::requireUrl('Components/PostHero/Assets/post-hero-dot-mobile.svg'),
        'alt' => 'dot'
    ];

    return $data;
});
