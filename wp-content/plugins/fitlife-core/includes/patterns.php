<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function fitlife_register_patterns() {

    register_block_pattern(
        'fitlife/hero-banner',

        array(
            'title'       => 'Hero Banner',
            'description' => 'Fitness hero section.',
            'categories'  => array( 'fitlife' ),

            'content'     => '
            <!-- wp:cover {"url":"","dimRatio":40} -->
            <div class="wp-block-cover">
                <span class="wp-block-cover__background"></span>

                <div class="wp-block-cover__inner-container">

                    <!-- wp:heading -->
                    <h2>Transform Your Fitness Journey</h2>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph -->
                    <p>Join FitLife today.</p>
                    <!-- /wp:paragraph -->

                    <!-- wp:buttons -->
                    <div class="wp-block-buttons">
                        <div class="wp-block-button">
                            <a class="wp-block-button__link">
                                Join Now
                            </a>
                        </div>
                    </div>
                    <!-- /wp:buttons -->

                </div>
            </div>
            <!-- /wp:cover -->
            ',
        )
    );


    register_block_pattern(
        'fitlife/trainer-grid',

        array(
            'title'       => 'Trainer Grid',
            'description' => 'Three trainer columns.',
            'categories'  => array( 'fitlife' ),

            'content'     => '
            <!-- wp:columns -->

            <div class="wp-block-columns">

                <!-- wp:column -->
                <div class="wp-block-column">
                    <h3>Trainer One</h3>
                </div>
                <!-- /wp:column -->

                <!-- wp:column -->
                <div class="wp-block-column">
                    <h3>Trainer Two</h3>
                </div>
                <!-- /wp:column -->

                <!-- wp:column -->
                <div class="wp-block-column">
                    <h3>Trainer Three</h3>
                </div>
                <!-- /wp:column -->

            </div>

            <!-- /wp:columns -->
            ',
        )
    );
}

add_action( 'init', 'fitlife_register_patterns' );


function fitlife_pattern_category() {

    register_block_pattern_category(

        'fitlife',

        array(
            'label' => 'FitLife Patterns'
        )

    );
}

add_action(
    'init',
    'fitlife_pattern_category'
);