<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function fitlife_register_blocks() {

    register_block_type(
        FITLIFE_CORE_PATH . 'gutenberg-blocks/fitlife-blocks/build/program-highlight'
    );

    register_block_type(
        FITLIFE_CORE_PATH . 'gutenberg-blocks/fitlife-blocks/build/trainer-spotlight'
    );
}

add_action( 'init', 'fitlife_register_blocks' );


function fitlife_register_block_variation() {
    ?>
    <script>

    wp.domReady( function() {

        wp.blocks.registerBlockVariation(

            'core/columns',

            {
                name: 'fitlife-three-columns',

                title: 'FitLife 3 Columns',

                description: 'Three equal columns.',

                attributes: {
                    columns: 3
                },

                innerBlocks: [

                    [ 'core/column' ],
                    [ 'core/column' ],
                    [ 'core/column' ]

                ],

                scope: [ 'inserter' ]
            }

        );

    });

    </script>
    <?php
}

add_action(
    'admin_footer',
    'fitlife_register_block_variation'
);