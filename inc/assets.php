<?php

use Flynt\Utils\Asset;
use Flynt\Utils\ScriptLoader;
use Timber\Timber;

call_user_func(function () {
    $loader = new ScriptLoader();
    add_filter('script_loader_tag', [$loader, 'filterScriptLoaderTag'], 10, 2);
});

add_action('wp_enqueue_scripts', function () {
    $no_js = false;
    $using_gmap = false;
    $context = Timber::get_context();

    if (strpos($context['body_class'], 'page-speed-1') !== false || strpos($context['body_class'], 'page-speed-2') !== false) {
        $no_js = true;
    }

    if (strpos($context['body_class'], 'single single-offset-project') !== false || strpos($context['body_class'], 'page-offsetting-projects') !== false) {
        $using_gmap = true;
    }

    if (!$no_js) {
        Asset::enqueue([
            'name' => 'Flynt/assets',
            'path' => 'assets/main.js',
            'type' => 'script',
            'inFooter' => true,
        ]);

        wp_script_add_data('Flynt/assets', 'defer', true);
        $data = [
            'ajaxurl' => admin_url('admin-ajax.php'),
            'templateDirectoryUri' => get_template_directory_uri(),
        ];
        wp_localize_script('Flynt/assets', 'FlyntData', $data);

        if ($using_gmap) {
            Asset::enqueue([
                'name' => 'Flynt/map',
                'path' => 'assets/map.js',
                'type' => 'script',
                'inFooter' => true,
            ]);
        }
    }
    
    Asset::enqueue([
        'name' => 'Flynt/assets',
        'path' => 'assets/main.css',
        'type' => 'style'
    ]);
});

add_action('admin_enqueue_scripts', function ($hook) {
    Asset::enqueue([
        'name' => 'Flynt/assets/admin',
        'path' => 'assets/admin.js',
        'type' => 'script',
        'inFooter' => true,
    ]);
    wp_script_add_data('Flynt/assets/admin', 'defer', true);
    $data = [
        'templateDirectoryUri' => get_template_directory_uri(),
    ];
    wp_localize_script('Flynt/assets/admin', 'FlyntData', $data);
    Asset::enqueue([
        'name' => 'Flynt/assets/admin',
        'path' => 'assets/admin.css',
        'type' => 'style'
    ]);
    // add frontend css and js for gutenberg editor at only post/page add new and edit
    if ($hook == 'post-new.php' || $hook == 'post.php') {
        Asset::enqueue([
            'name' => 'Flynt/assets',
            'path' => 'assets/main.js',
            'type' => 'script',
            'inFooter' => true,
        ]);
        wp_script_add_data('Flynt/assets', 'defer', true);
        $data = [
            'templateDirectoryUri' => get_template_directory_uri(),
        ];
        wp_localize_script('Flynt/assets', 'FlyntData', $data);
        Asset::enqueue([
            'name' => 'Flynt/assets',
            'path' => 'assets/main.css',
            'type' => 'style'
        ]);
    }
}, 10, 1);
