<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function fitlife_programs_shortcode( $atts ) {

    $atts = shortcode_atts(
        array(
            'type' => '',
            'posts_per_page' => 6
        ),
        $atts
    );

    $args = array(
        'post_type' => 'fitlife_program',
        'posts_per_page' => $atts['posts_per_page']
    );

    if ( ! empty( $atts['type'] ) ) {

        $args['tax_query'] = array(
            array(
                'taxonomy' => 'program_type',
                'field'    => 'slug',
                'terms'    => $atts['type']
            )
        );
    }

    $query = new WP_Query( $args );

    ob_start();

    echo '<div class="fitlife-program-grid">';

    while ( $query->have_posts() ) {

        $query->the_post();

        ?>

        <div class="program-card">

            <?php the_post_thumbnail(); ?>

            <h3><?php the_title(); ?></h3>

            <?php the_excerpt(); ?>

        </div>

        <?php
    }

    echo '</div>';

    wp_reset_postdata();

    return ob_get_clean();
}

add_shortcode(
    'fitlife_programs',
    'fitlife_programs_shortcode'
);