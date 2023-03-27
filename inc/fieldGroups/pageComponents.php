<?php

// use ACFComposer\ACFComposer;
// use Flynt\Components;

// add_action('Flynt/afterRegisterComponents', function () {
//     ACFComposer::registerFieldGroup([
//         'name' => 'pageComponents',
//         'title' => 'Page Components',
//         'style' => 'seamless',
//         'fields' => [
//             [
//                 'name' => 'pageComponents',
//                 'label' => __('Page Components', 'flynt'),
//                 'type' => 'flexible_content',
//                 'button_label' => __('Add Component', 'flynt'),
//                 'layouts' => [
//                     Components\BlockCollapse\getACFLayout(),
//                     Components\BlockImage\getACFLayout(),
//                     Components\BlockImageText\getACFLayout(),
//                     Components\BlockVideoOembed\getACFLayout(),
//                     Components\BlockWysiwyg\getACFLayout(),
//                     Components\GridImageText\getACFLayout(),
//                     Components\GridPostsLatest\getACFLayout(),
//                     Components\ListComponents\getACFLayout(),
//                     Components\SliderImages\getACFLayout(),
//                 ]
//             ]
//         ],
//         'location' => [
//             [
//                 [
//                     'param' => 'post_type',
//                     'operator' => '!=',
//                     'value' => 'post'
//                 ]
//             ]
//         ]
//     ]);
// });

if (function_exists('acf_add_local_field_group')) :
    acf_add_local_field_group(array(
        'key' => 'group_62257fb9bc9fb',
        'title' => 'Page Metabox',
        'fields' => array(
            array(
                'key' => 'field_62257fc58f499',
                'label' => 'White Header',
                'name' => 'white_header',
                'type' => 'true_false',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'message' => '',
                'default_value' => 0,
                'ui' => 0,
                'ui_on_text' => '',
                'ui_off_text' => '',
            ),
            array(
                'key' => 'field_62257fc58f491',
                'label' => 'Header Has Dark Background',
                'name' => 'header_has_dark_background',
                'type' => 'true_false',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'message' => '',
                'default_value' => 0,
                'ui' => 0,
                'ui_on_text' => '',
                'ui_off_text' => '',
            ),
            array(
                'key' => 'field_62257fc58f490',
                'label' => 'Page Has Google Map',
                'name' => 'page_has_google_map',
                'type' => 'true_false',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'message' => '',
                'default_value' => 0,
                'ui' => 0,
                'ui_on_text' => '',
                'ui_off_text' => '',
            )
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ));
endif;
