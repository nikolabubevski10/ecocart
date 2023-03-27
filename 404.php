<?php

use Timber\Timber;
use Flynt\Utils\Options;

$context = Timber::get_context();
$context['title'] = Options::getGlobal('404 Page Settings', 'title');
$context['content'] = Options::getGlobal('404 Page Settings', 'content');
$context['link'] = Options::getGlobal('404 Page Settings', 'link');
$context['desktop_image'] = Options::getGlobal('404 Page Settings', 'desktop_image');
$context['mobile_image'] = Options::getGlobal('404 Page Settings', 'mobile_image');

Timber::render('templates/404.twig', $context);
