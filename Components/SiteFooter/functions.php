<?php

namespace Flynt\Components\SiteFooter;

use Timber;
use Flynt\Utils\Options;
use Flynt\Utils\Asset;
use Timber\Menu;

add_action('init', function () {
    register_nav_menus([
        'footer_menu_1' => __('Footer Menu 1', 'flynt'),
        'footer_menu_2' => __('Footer Menu 2', 'flynt'),
    ]);
});

add_filter('Flynt/addComponentData?name=SiteFooter', function ($data) {
    $data['footer_menu_1'] = new Menu('footer_menu_1');
    $data['footer_menu_2'] = new Menu('footer_menu_2');

    $data['facebook_url'] = Options::getGlobal('Footer Settings', 'facebook_url');
    $data['twitter_url'] = Options::getGlobal('Footer Settings', 'twitter_url');
    $data['linkedin_url'] = Options::getGlobal('Footer Settings', 'linkedin_url');
    $data['instagram_url'] = Options::getGlobal('Footer Settings', 'instagram_url');
    $data['gravity_form_title'] = Options::getGlobal('Footer Settings', 'gravity_form_title');
    $data['gravity_form_shortcode'] = Options::getGlobal('Footer Settings', 'gravity_form_shortcode');
    $data['hubspot_form_code'] = Options::getGlobal('Footer Settings', 'hubspot_form_code');
    $data['dot_desktop'] = Asset::requireUrl('Components/SiteFooter/Assets/footer-dot-desktop.svg');
    $data['dot_mobile'] = Asset::requireUrl('Components/SiteFooter/Assets/footer-dot-mobile.svg');

    return $data;
});
