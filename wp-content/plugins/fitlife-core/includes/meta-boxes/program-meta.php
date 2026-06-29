<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


function fitlife_add_program_meta_box() {

    add_meta_box(
        'fitlife_program_details',
        'Program Details',
        'fitlife_program_meta_callback',
        'fitlife_program',
        'normal',
        'default'
    );
}

add_action( 'add_meta_boxes', 'fitlife_add_program_meta_box' );



function fitlife_program_meta_callback( $post ) {

    wp_nonce_field(
        'fitlife_save_program_meta',
        'fitlife_program_nonce'
    );

    $duration = get_post_meta(
        $post->ID,
        '_fitlife_duration',
        true
    );

    $difficulty = get_post_meta(
        $post->ID,
        '_fitlife_difficulty',
        true
    );

    $equipment = get_post_meta(
        $post->ID,
        '_fitlife_equipment',
        true
    );

    $max_participants = get_post_meta(
        $post->ID,
        '_fitlife_max_participants',
        true
    );

    ?>

    <p>
        <label for="fitlife_duration">
            <strong>Duration (Weeks)</strong>
        </label>
        <input
            type="number"
            id="fitlife_duration"
            name="fitlife_duration"
            class="widefat"
            value="<?php echo esc_attr( $duration ); ?>"
        >
    </p>

    <p>
        <label for="fitlife_difficulty">
            <strong>Difficulty Level</strong>
        </label>

        <select
            id="fitlife_difficulty"
            name="fitlife_difficulty"
            class="widefat"
        >

            <option value="Beginner"
                <?php selected( $difficulty, 'Beginner' ); ?>>
                Beginner
            </option>

            <option value="Intermediate"
                <?php selected( $difficulty, 'Intermediate' ); ?>>
                Intermediate
            </option>

            <option value="Advanced"
                <?php selected( $difficulty, 'Advanced' ); ?>>
                Advanced
            </option>

        </select>
    </p>

    <p>
        <label for="fitlife_equipment">
            <strong>Equipment Required</strong>
        </label>

        <textarea
            id="fitlife_equipment"
            name="fitlife_equipment"
            class="widefat"
            rows="4"><?php echo esc_textarea( $equipment ); ?></textarea>
    </p>

    <p>
        <label for="fitlife_max_participants">
            <strong>Maximum Participants</strong>
        </label>

        <input
            type="number"
            id="fitlife_max_participants"
            name="fitlife_max_participants"
            class="widefat"
            value="<?php echo esc_attr( $max_participants ); ?>"
        >
    </p>

    <?php
}


/*
|--------------------------------------------------------------------------
| Save Meta Data
|--------------------------------------------------------------------------
*/

function fitlife_save_program_meta( $post_id ) {

    // Verify nonce
    if (
        ! isset( $_POST['fitlife_program_nonce'] ) ||
        ! wp_verify_nonce(
            $_POST['fitlife_program_nonce'],
            'fitlife_save_program_meta'
        )
    ) {
        return;
    }

    // Prevent autosave overwrite
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check permission
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Save fields

    if ( isset( $_POST['fitlife_duration'] ) ) {

        update_post_meta(
            $post_id,
            '_fitlife_duration',
            intval( $_POST['fitlife_duration'] )
        );
    }

    if ( isset( $_POST['fitlife_difficulty'] ) ) {

        update_post_meta(
            $post_id,
            '_fitlife_difficulty',
            sanitize_text_field(
                $_POST['fitlife_difficulty']
            )
        );
    }

    if ( isset( $_POST['fitlife_equipment'] ) ) {

        update_post_meta(
            $post_id,
            '_fitlife_equipment',
            sanitize_textarea_field(
                $_POST['fitlife_equipment']
            )
        );
    }

    if ( isset( $_POST['fitlife_max_participants'] ) ) {

        update_post_meta(
            $post_id,
            '_fitlife_max_participants',
            intval(
                $_POST['fitlife_max_participants']
            )
        );
    }
}

add_action(
    'save_post_fitlife_program',
    'fitlife_save_program_meta'
);