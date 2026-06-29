<?php


add_filter(
    'manage_fitlife_trainer_posts_columns',
    function( $columns ) {

        $columns['specialty'] = 'Specialty';

        return $columns;
    }
);

add_action(
    'manage_fitlife_trainer_posts_custom_column',
    function( $column, $post_id ) {

        if ( $column === 'specialty' ) {

            $terms = get_the_term_list(
                $post_id,
                'specialty',
                '',
                ', '
            );

            echo $terms ?: 'No Specialty';

        }

    },
    10,
    2
);