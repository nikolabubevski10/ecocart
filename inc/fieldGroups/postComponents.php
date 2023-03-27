<?php

use ACFComposer\ACFComposer;
use Flynt\Components;

add_action('Flynt/afterRegisterComponents', function () {
    ACFComposer::registerFieldGroup([
        'name' => 'postCaseStudyComponents',
        'title' => 'Post Case Study Components',
        'style' => 'seamless',
        'fields' => [
            [
                'name' => 'postCaseStudyComponents',
                'label' => __('Post Case Study Components', 'flynt'),
                'type' => 'flexible_content',
                'button_label' => __('Add Component', 'flynt'),
                'layouts' => [
                    Components\CaseStudyHero\getACFLayout(),
                    Components\ThreeCards\getACFLayout(),
                    Components\FourCards\getACFLayout(),
                    Components\About\getACFLayout(),
                    Components\Challenge\getACFLayout(),
                    Components\Solution\getACFLayout(),
                    Components\Result\getACFLayout(),
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_category',
                    'operator' => '==',
                    'value' => 'category:case-studies',
                ],
            ],
        ],
        'hide_on_screen' => [
            'the_content'
        ]
    ]);
});

// add custom default layout
add_filter('acf/load_value/name=postCaseStudyComponents', function ($value) {
    if ($value !== null) {
        return $value;
    }

    // add default layouts
    $value = [
        [ 'acf_fc_layout' => 'caseStudyHero' ],
        [ 'acf_fc_layout' => 'threeCards' ],
        [ 'acf_fc_layout' => 'fourCards' ],
        [ 'acf_fc_layout' => 'about' ],
        [ 'acf_fc_layout' => 'challenge' ],
        [ 'acf_fc_layout' => 'solution' ],
        [ 'acf_fc_layout' => 'result' ],
    ];

    return $value;
}, 10, 3);
