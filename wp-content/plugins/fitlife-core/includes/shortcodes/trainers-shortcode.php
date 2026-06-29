<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function fitlife_trainers_shortcode( $atts ) {

    $atts = shortcode_atts(
        array(
            'posts_per_page' => 6
        ),
        $atts
    );

    $query = new WP_Query( array(
        'post_type' => 'fitlife_trainer',
        'posts_per_page' => $atts['posts_per_page']
    ) );

    ob_start();

    echo '<div class="fitlife-trainers-grid">';

    while ( $query->have_posts() ) {

        $query->the_post();

        ?>

        <div class="trainer-card">

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
    'fitlife_trainers',
    'fitlife_trainers_shortcode'
);