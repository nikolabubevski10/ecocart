<?php

namespace Flynt\Acf;

use Flynt\Utils\Options;

add_filter('pre_http_request', function ($preempt, $args, $url) {
    if (strpos($url, 'https://www.youtube.com/oembed') !== false || strpos($url, 'https://vimeo.com/api/oembed') !== false) {
        $response = wp_cache_get($url, 'oembedCache');
        if (!empty($response)) {
            return $response;
        }
    }
    return false;
}, 10, 3);

add_filter('http_response', function ($response, $args, $url) {
    if (strpos($url, 'https://www.youtube.com/oembed') !== false || strpos($url, 'https://vimeo.com/api/oembed') !== false) {
        wp_cache_set($url, $response, 'oembedCache');
    }
    return $response;
}, 10, 3);

add_filter('acf/fields/google_map/api', function ($api) {
    $apiKey = Options::getGlobal('Acf', 'googleMapsApiKey');
    if ($apiKey) {
        $api['key'] = $apiKey;
    }
    return $api;
});

Options::addGlobal('Acf', [
    [
        'name' => 'googleMapsApiKey',
        'label' => __('Google Maps Api Key', 'flynt'),
        'type' => 'text',
        'maxlength' => 100,
        'prepend' => '',
        'append' => '',
        'placeholder' => ''
    ]
]);

// Website global settings
Options::addGlobal('Website Settings', [
    [
        'label' => 'Website Scripts',
        'name' => 'website_scripts',
        'type' => 'group',
        'layout' => 'row',
        'sub_fields' => [
            [
                'label' => 'Run tracking scripts?',
                'name' => 'run_tracking_scripts',
                'type' => 'true_false',
                'ui' => true,
                'ui_on_text' => 'Yes',
                'ui_off_text' => 'No',
            ],
            [
                'label' => 'Before head closing tag',
                'name' => 'before_head_closing_tag',
                'type' => 'textarea',
                'default_value' => '',
            ],
            [
                'label' => 'After body opening tag',
                'name' => 'after_body_opening_tag',
                'type' => 'textarea',
                'default_value' => '',
            ],
            [
                'label' => 'Before body closing tag',
                'name' => 'begore_body_closing_tag',
                'type' => 'textarea',
                'default_value' => '',
            ],
        ]
    ],
]);

Options::addGlobal('Header Settings', [
    [
        [
            'label' => 'Right Link',
            'name' => 'right_link',
            'type' => 'link',
        ],
    ]
]);

Options::addGlobal('Footer Settings', [
    [
        [
            'name' => 'facebook_url',
            'label' => 'Facebook URL',
            'type' => 'url',
        ],
        [
            'name' => 'twitter_url',
            'label' => 'Twitter URL',
            'type' => 'url',
        ],
        [
            'name' => 'linkedin_url',
            'label' => 'Linkedin URL',
            'type' => 'url',
        ],
        [
            'name' => 'instagram_url',
            'label' => 'Instagram URL',
            'type' => 'url',
        ],
        [
            'name' => 'gravity_form_title',
            'label' => 'Gravity Form Title',
            'type' => 'text',
        ],
        [
            'name' => 'gravity_form_shortcode',
            'label' => 'Gravity Form Shortcode',
            'type' => 'text',
        ],
        [
            'name' => 'hubspot_form_code',
            'label' => 'Hubspot Form Code',
            'type' => 'textarea',
        ],
    ]
]);

Options::addGlobal('Single Blog Settings', [
    [
        [
            'label' => 'Archive Link',
            'name' => 'archive_link',
            'type' => 'link',
        ],
        [
            'label' => 'CTA Image',
            'name' => 'cta_image',
            'type' => 'image',
            'preview_size' => 'medium',
        ],
        [
            'label' => 'CTA Title',
            'name' => 'cta_title',
            'type' => 'text',
        ],
        [
            'label' => 'CTA Link',
            'name' => 'cta_link',
            'type' => 'link',
        ]
    ]
]);

Options::addGlobal('Blog Archive Settings', [
    [
        [
            'label' => 'Hero Image',
            'name' => 'hero_image',
            'type' => 'image',
            'preview_size' => 'medium',
        ],
        [
            'label' => 'Hero Title',
            'name' => 'hero_title',
            'type' => 'text',
        ],
        [
            'label' => 'Hero Content',
            'name' => 'hero_content',
            'type' => 'textarea',
        ],
        [
            'label' => 'CTA Image',
            'name' => 'cta_image',
            'type' => 'image',
            'preview_size' => 'medium',
        ],
        [
            'label' => 'CTA Title',
            'name' => 'cta_title',
            'type' => 'text',
        ],
        [
            'label' => 'CTA Link',
            'name' => 'cta_link',
            'type' => 'link',
        ]
    ]
]);

Options::addGlobal('Single Offset Project Settings', [
    [
        [
            'label' => 'Archive Link',
            'name' => 'archive_link',
            'type' => 'link',
        ],
        [
            'label' => 'CTA Image',
            'name' => 'cta_image',
            'type' => 'image',
            'preview_size' => 'medium',
        ],
        [
            'label' => 'CTA Title',
            'name' => 'cta_title',
            'type' => 'text',
        ],
        [
            'label' => 'CTA Link',
            'name' => 'cta_link',
            'type' => 'link',
        ]
    ]
]);

Options::addGlobal('404 Page Settings', [
    [
        [
            'label' => 'Title',
            'name' => 'title',
            'type' => 'text',
        ],
        [
            'label' => 'Content',
            'name' => 'content',
            'type' => 'textarea',
        ],
        [
            'label' => 'Link',
            'name' => 'link',
            'type' => 'link',
        ],
        [
            'label' => 'Desktop Image',
            'name' => 'desktop_image',
            'type' => 'image',
            'wrapper' => [
                'width' => 50
            ]
        ],
        [
            'label' => 'Mobile Image',
            'name' => 'mobile_image',
            'type' => 'image',
            'wrapper' => [
                'width' => 50
            ]
        ],
    ]
]);
