<?php

use Timber\Timber;
use Timber\Post;
use Flynt\Utils\Asset;

$context = Timber::get_context();
$context['post'] = new Post();

$context['is_home_page'] = is_front_page();
$context['home_phone_svg'] = Asset::requireUrl('Components/HomepageHero/Assets/home-phone.svg');

Timber::render('templates/page.twig', $context);
