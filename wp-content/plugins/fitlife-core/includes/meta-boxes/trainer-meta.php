<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


function fitlife_add_trainer_meta_box() {

    add_meta_box(
        'fitlife_trainer_details',
        'Trainer Details',
        'fitlife_trainer_meta_callback',
        'fitlife_trainer',
        'normal',
        'default'
    );
}

add_action( 'add_meta_boxes', 'fitlife_add_trainer_meta_box' );



function fitlife_trainer_meta_callback( $post ) {

    wp_nonce_field(
        'fitlife_save_trainer_meta',
        'fitlife_trainer_nonce'
    );

    $certification = get_post_meta(
        $post->ID,
        '_fitlife_certification',
        true
    );

    $experience = get_post_meta(
        $post->ID,
        '_fitlife_experience',
        true
    );

    $instagram = get_post_meta(
        $post->ID,
        '_fitlife_instagram',
        true
    );

    $youtube = get_post_meta(
        $post->ID,
        '_fitlife_youtube',
        true
    );

    $hourly_rate = get_post_meta(
        $post->ID,
        '_fitlife_hourly_rate',
        true
    );

    ?>

    <p>
        <label><strong>Certification</strong></label><br>

        <input
            type="text"
            name="fitlife_certification"
            value="<?php echo esc_attr( $certification ); ?>"
            class="widefat">
    </p>

    <p>
        <label><strong>Years of Experience</strong></label><br>

        <input
            type="number"
            name="fitlife_experience"
            value="<?php echo esc_attr( $experience ); ?>"
            class="widefat">
    </p>

    <p>
        <label><strong>Instagram URL</strong></label><br>

        <input
            type="url"
            name="fitlife_instagram"
            value="<?php echo esc_url( $instagram ); ?>"
            class="widefat">
    </p>

    <p>
        <label><strong>YouTube URL</strong></label><br>

        <input
            type="url"
            name="fitlife_youtube"
            value="<?php echo esc_url( $youtube ); ?>"
            class="widefat">
    </p>

    <p>
        <label><strong>Hourly Rate ($)</strong></label><br>

        <input
            type="number"
            name="fitlife_hourly_rate"
            value="<?php echo esc_attr( $hourly_rate ); ?>"
            class="widefat">
    </p>

    <?php
}


/*
|--------------------------------------------------------------------------
| Save Meta Data
|--------------------------------------------------------------------------
*/

function fitlife_save_trainer_meta( $post_id ) {

    if (
        ! isset( $_POST['fitlife_trainer_nonce'] ) ||
        ! wp_verify_nonce(
            $_POST['fitlife_trainer_nonce'],
            'fitlife_save_trainer_meta'
        )
    ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    update_post_meta(
        $post_id,
        '_fitlife_certification',
        sanitize_text_field(
            $_POST['fitlife_certification']
        )
    );

    update_post_meta(
        $post_id,
        '_fitlife_experience',
        intval(
            $_POST['fitlife_experience']
        )
    );

    update_post_meta(
        $post_id,
        '_fitlife_instagram',
        esc_url_raw(
            $_POST['fitlife_instagram']
        )
    );

    update_post_meta(
        $post_id,
        '_fitlife_youtube',
        esc_url_raw(
            $_POST['fitlife_youtube']
        )
    );

    update_post_meta(
        $post_id,
        '_fitlife_hourly_rate',
        floatval(
            $_POST['fitlife_hourly_rate']
        )
    );
}

add_action(
    'save_post_fitlife_trainer',
    'fitlife_save_trainer_meta'
);