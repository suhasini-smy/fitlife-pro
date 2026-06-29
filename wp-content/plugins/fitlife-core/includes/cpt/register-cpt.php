<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function fitlife_register_cpt() {


    register_post_type( 'fitlife_trainer', array(

        'labels' => array(
            'name'          => 'Trainers',
            'singular_name' => 'Trainer',
            'add_new_item'  => 'Add New Trainer',
            'edit_item'     => 'Edit Trainer',
            'all_items'     => 'All Trainers'
        ),

        'public'        => true,
        'has_archive'   => true,
        'show_in_rest'  => true,
        'menu_icon'     => 'dashicons-businessperson',

        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt'
        ),

        'rewrite' => array(
            'slug' => 'trainers'
        )

    ) );




    register_post_type( 'fitlife_program', array(

        'labels' => array(
            'name'          => 'Programs',
            'singular_name' => 'Program',
            'add_new_item'  => 'Add New Program',
            'edit_item'     => 'Edit Program',
            'all_items'     => 'All Programs'
        ),

        'public'       => true,
        'has_archive'  => true,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-welcome-learn-more',

        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt'
        ),

        'rewrite' => array(
            'slug' => 'programs'
        )

    ) );



    register_taxonomy(

        'specialty',

        array( 'fitlife_trainer' ),

        array(

            'labels' => array(
                'name'          => 'Specialties',
                'singular_name' => 'Specialty'
            ),

            'public'        => true,
            'hierarchical'  => true,
            'show_in_rest'  => true,
            'rewrite' => array(
                'slug' => 'specialty'
            )

        )

    );



    register_taxonomy(

        'program_type',

        array( 'fitlife_program' ),

        array(

            'labels' => array(
                'name'          => 'Program Types',
                'singular_name' => 'Program Type'
            ),

            'public'       => true,
            'hierarchical' => true,
            'show_in_rest' => true,

            'rewrite' => array(
                'slug' => 'program-type'
            )

        )

    );

}

add_action( 'init', 'fitlife_register_cpt' );

