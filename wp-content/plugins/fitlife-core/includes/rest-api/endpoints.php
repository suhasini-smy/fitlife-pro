<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function fitlife_register_rest_routes() {
    

    register_rest_route(
        'fitlife/v1',
        '/trainers',
        array(
            'methods'  => WP_REST_Server::READABLE,
            'callback' => 'fitlife_get_trainers',
            'permission_callback' => '__return_true'
        )
    );



    register_rest_route(
        'fitlife/v1',
        '/programs',
        array(
            'methods'  => WP_REST_Server::READABLE,
            'callback' => 'fitlife_get_programs',
            'permission_callback' => '__return_true'
        )
    );


    register_rest_route(
        'fitlife/v1',
        '/programs',
        array(
            'methods'  => WP_REST_Server::CREATABLE,
            'callback' => 'fitlife_create_program',
            'permission_callback' => function () {
                return current_user_can( 'edit_posts' );
            }
        )
    );
}


function fitlife_get_trainers( $request ) {

    $specialty = $request->get_param( 'specialty' );

    $args = array(
        'post_type'      => 'fitlife_trainer',
        'posts_per_page' => -1
    );

    if ( $specialty ) {

        $args['tax_query'] = array(
            array(
                'taxonomy' => 'specialty',
                'field'    => 'slug',
                'terms'    => $specialty
            )
        );
    }

    $query = new WP_Query( $args );

    $data = array();

    while ( $query->have_posts() ) {

        $query->the_post();

        $data[] = array(
            'id'    => get_the_ID(),
            'title' => get_the_title(),
            'link'  => get_permalink()
        );
    }

    wp_reset_postdata();

    return rest_ensure_response( $data );
}


function fitlife_get_programs( $request ) {

    $type       = $request->get_param( 'type' );
    $difficulty = $request->get_param( 'difficulty' );

    $args = array(
        'post_type'      => 'fitlife_program',
        'posts_per_page' => -1
    );

    if ( $type ) {

        $args['tax_query'][] = array(
            'taxonomy' => 'program_type',
            'field'    => 'slug',
            'terms'    => $type
        );
    }

    if ( $difficulty ) {

        $args['meta_query'][] = array(
            'key'   => '_fitlife_difficulty',
            'value' => $difficulty
        );
    }

    $query = new WP_Query( $args );

    $data = array();

    while ( $query->have_posts() ) {

        $query->the_post();

        $data[] = array(
            'id'         => get_the_ID(),
            'title'      => get_the_title(),
            'difficulty' => get_post_meta(
                get_the_ID(),
                '_fitlife_difficulty',
                true
            ),
            'link'       => get_permalink()
        );
    }

    wp_reset_postdata();

    return rest_ensure_response( $data );
}



function fitlife_create_program( $request ) {

    $title = sanitize_text_field(
        $request->get_param( 'title' )
    );

    $content = wp_kses_post(
        $request->get_param( 'content' )
    );

    $post_id = wp_insert_post( array(
        'post_title'   => $title,
        'post_content' => $content,
        'post_type'    => 'fitlife_program',
        'post_status'  => 'publish'
    ) );

    if ( is_wp_error( $post_id ) ) {

        return new WP_Error(
            'cannot_create',
            'Program could not be created',
            array( 'status' => 500 )
        );
    }

    return rest_ensure_response( array(
        'success' => true,
        'post_id' => $post_id
    ) );
}
add_action( 'rest_api_init', 'fitlife_register_rest_routes' );

