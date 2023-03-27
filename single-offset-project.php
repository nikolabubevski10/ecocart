<?php

use Timber\Timber;
use Timber\Post;
use Flynt\Utils\Options;
use Flynt\Utils\Asset;

$context = Timber::get_context();
$context['post'] = new Post();
$context['archive_link'] = Options::getGlobal('Single Offset Project Settings', 'archive_link');
$context['cta_image'] = Options::getGlobal('Single Offset Project Settings', 'cta_image');
$context['cta_title'] = Options::getGlobal('Single Offset Project Settings', 'cta_title');
$context['cta_link'] = Options::getGlobal('Single Offset Project Settings', 'cta_link');
$context['cta_dot_mobile'] = Asset::requireUrl('Components/VerticalsCTA/Assets/dot-mobile.svg');
$context['page_has_google_map'] = true;

Timber::render('templates/single-offset-project.twig', $context);
