<?php

namespace TGHP\$tghp:classCase$\PostType;

use TGHP\$tghp:classCase$\$tghp:classCase$;

class Thing extends AbstractPostType
{

    /**
     * Defined post type as constant here so if can it can be accessed
     * outside of this class without creating a new instantiation
     */
    const POST_TYPE_CODE = 'thing';

    /**
     * {@inheritDoc}
     */
    protected $postTypeCode = self::POST_TYPE_CODE;

    /**
     * {@inheritDoc}
     */
    public function define(): array
    {
        $singular = 'Thing';
        $plural = 'Things';

        return [
            'label' => _x($singular, $tghp:classCase$::getTextDomain()),
            'description' => _x($singular, $tghp:classCase$::getTextDomain()),
            'labels' => [
                'name' => _x($singular, $tghp:classCase$::getTextDomain()),
                'singular_name' => _x($singular, $tghp:classCase$::getTextDomain()),
                'menu_name' => _x($singular, $tghp:classCase$::getTextDomain()),
                'name_admin_bar' => _x($singular, $tghp:classCase$::getTextDomain()),
                'all_items' => _x("All {$plural}", $tghp:classCase$::getTextDomain()),
                'add_new_item' => _x("Add New {$singular}", $tghp:classCase$::getTextDomain()),
                'add_new' => _x("New {$singular}", $tghp:classCase$::getTextDomain()),
                'new_item' => _x("New {$singular}", $tghp:classCase$::getTextDomain()),
                'edit_item' => _x("Edit {$singular}", $tghp:classCase$::getTextDomain()),
                'update_item' => _x("Update {$singular}", $tghp:classCase$::getTextDomain()),
                'view_item' => _x("View {$singular}", $tghp:classCase$::getTextDomain()),
                'search_items' => _x("Search {$singular}", $tghp:classCase$::getTextDomain()),
                'not_found' => _x("Not found", $tghp:classCase$::getTextDomain()),
                'not_found_in_trash' => _x("Not found in Trash", $tghp:classCase$::getTextDomain()),
            ],
            'supports' => [
                'title',
//                'thumbnail',
//                'editor',
//                'author',
//                'excerpt',
//                'revisions',
//                'page-attributes'
            ],
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'rewrite' => [
                'slug' => strtolower($singular),
            ],
            'show_in_menu' => true,
            'menu_position' => null,
            'has_archive' => false,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'capability_type' => 'page',
            'show_in_rest' => true,
            /* @see https://developer.wordpress.org/resource/dashicons/#visibility */
            'menu_icon' => 'dashicons-default',
            'show_in_graphql' => true,
            'graphql_single_name' => strtolower($singular),
            'graphql_plural_name' => strtolower($plural),
        ];
    }

}
