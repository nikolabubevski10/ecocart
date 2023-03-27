<?php

namespace Flynt\CustomPostTypes;

function registerOffsetProjectPostType()
{
    $labels = [
        'name'                  => _x('Offset Projects', 'Offset Project General Name', 'flynt'),
        'singular_name'         => _x('Offset Project', 'Offset Project Singular Name', 'flynt'),
        'menu_name'             => __('Offset Projects', 'flynt'),
        'name_admin_bar'        => __('Offset Project', 'flynt'),
        'archives'              => __('Item Archives', 'flynt'),
        'attributes'            => __('Item Attributes', 'flynt'),
        'parent_item_colon'     => __('Parent Item:', 'flynt'),
        'all_items'             => __('All Offset Projects', 'flynt'),
        'add_new_item'          => __('Add New Offset Project', 'flynt'),
        'add_new'               => __('Add New', 'flynt'),
        'new_item'              => __('New Offset Project', 'flynt'),
        'edit_item'             => __('Edit Offset Project', 'flynt'),
        'update_item'           => __('Update Offset Project', 'flynt'),
        'view_item'             => __('View Offset Project', 'flynt'),
        'view_items'            => __('View Offset Projects', 'flynt'),
        'search_items'          => __('Search Offset Project', 'flynt'),
        'not_found'             => __('Not found', 'flynt'),
        'not_found_in_trash'    => __('Not found in Trash', 'flynt'),
        'featured_image'        => __('Featured Image', 'flynt'),
        'set_featured_image'    => __('Set featured image', 'flynt'),
        'remove_featured_image' => __('Remove featured image', 'flynt'),
        'use_featured_image'    => __('Use as featured image', 'flynt'),
        'insert_into_item'      => __('Insert into item', 'flynt'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'flynt'),
        'items_list'            => __('Items list', 'flynt'),
        'items_list_navigation' => __('Items list navigation', 'flynt'),
        'filter_items_list'     => __('Filter items list', 'flynt'),
    ];
    $args = [
        'label'                 => __('Offset Project', 'flynt'),
        'description'           => __('Offset Project Description', 'flynt'),
        'labels'                => $labels,
        'supports'              => ['title', 'thumbnail'],
        // 'taxonomies'            => ['project-type'],
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
        'menu_icon'             => 'dashicons-analytics',
        'show_in_rest'          => true,
    ];
    register_post_type('offset-project', $args);
}

add_action('init', '\\Flynt\\CustomPostTypes\\registerOffsetProjectPostType');
