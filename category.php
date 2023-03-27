<?php

use Timber\Timber;
use Timber\Post;
use Flynt\Utils\Options;
use Flynt\Utils\Asset;

$context = Timber::get_context();
$context['post'] = new Post();
$context['hero_image'] = Options::getGlobal('Blog Archive Settings', 'hero_image');
$context['hero_title'] = Options::getGlobal('Blog Archive Settings', 'hero_title');
$context['hero_content'] = Options::getGlobal('Blog Archive Settings', 'hero_content');
$context['cta_image'] = Options::getGlobal('Blog Archive Settings', 'cta_image');
$context['cta_title'] = Options::getGlobal('Blog Archive Settings', 'cta_title');
$context['cta_link'] = Options::getGlobal('Blog Archive Settings', 'cta_link');
$context['cta_dot_mobile'] = Asset::requireUrl('Components/VerticalsCTA/Assets/dot-mobile.svg');
$context['current_cat_id'] = get_query_var('cat');

Timber::render('templates/category.twig', $context);
