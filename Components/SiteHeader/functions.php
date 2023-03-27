<?php

namespace Flynt\Components\SiteHeader;

use Timber;
use Flynt\Utils\Options;
use Timber\Menu;

add_action('init', function () {
    register_nav_menus([
        'header_menu' => __('Header Menu', 'flynt')
    ]);
});

add_filter('Flynt/addComponentData?name=SiteHeader', function ($data) {
    $data['header_menu'] = new Menu('header_menu');
    $data['right_link'] = Options::getGlobal('Header Settings', 'right_link');

    return $data;
});
