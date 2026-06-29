<?php

$trainer_id = $attributes['trainerId'];

if ( ! $trainer_id ) {
    return '<p>Please select a trainer.</p>';
}

$post = get_post( $trainer_id );

if ( ! $post ) {
    return '<p>Trainer not found.</p>';
}

ob_start();

?>

<div class="trainer-spotlight">

    <?php echo get_the_post_thumbnail(
        $trainer_id,
        'medium'
    ); ?>

    <h3>
        <?php echo esc_html( $post->post_title ); ?>
    </h3>

    <p>

        <?php

        $terms = get_the_terms(
            $trainer_id,
            'specialty'
        );

        if ( $terms ) {

            echo esc_html(
                $terms[0]->name
            );
        }

        ?>

    </p>

    <a href="<?php echo esc_url(
        get_permalink( $trainer_id )
    ); ?>">

        Book Now

    </a>

</div>

<?php

return ob_get_clean();