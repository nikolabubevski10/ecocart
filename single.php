<?php

use Timber\Timber;
use Timber\Post;
use Flynt\Utils\Options;
use Flynt\Utils\Asset;

$context = Timber::get_context();
$context['post'] = new Post();
$context['cta_image'] = Options::getGlobal('Single Blog Settings', 'cta_image');
$context['cta_title'] = Options::getGlobal('Single Blog Settings', 'cta_title');
$context['cta_link'] = Options::getGlobal('Single Blog Settings', 'cta_link');
$context['cta_dot_mobile'] = Asset::requireUrl('Components/VerticalsCTA/Assets/dot-mobile.svg');
$context['archive_link'] = Options::getGlobal('Single Blog Settings', 'archive_link');

// check post has case-study category
$has_case_study_category_slug = false;

foreach ($context['post']->terms('category') as $cat) {
    if ($cat->slug === 'case-studies') {
        $has_case_study_category_slug = true;
        break;
    }
}

if ($has_case_study_category_slug) {
    Timber::render('templates/single-case-study.twig', $context);
} else {
    Timber::render('templates/single.twig', $context);
}
