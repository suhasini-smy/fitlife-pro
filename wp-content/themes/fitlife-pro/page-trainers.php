<?php

get_header();

$specialty = isset($_GET['specialty'])
    ? sanitize_text_field($_GET['specialty'])
    : '';

?>

<div class="container">

<form method="GET">

<?php

wp_dropdown_categories(array(
    'taxonomy' => 'specialty',
    'name' => 'specialty',
    'show_option_all' => 'All Specialties',
    'selected' => $specialty
));

?>

<button type="submit">
Filter
</button>

</form>

<?php

$args = array(
    'post_type' => 'fitlife_trainer',
    'posts_per_page' => -1
);

if ($specialty) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'specialty',
            'field' => 'slug',
            'terms' => $specialty
        )
    );
}

$query = new WP_Query($args);

if ($query->have_posts()) :

    while ($query->have_posts()) : $query->the_post();
?>

<article>

<?php the_post_thumbnail(); ?>

<h2><?php the_title(); ?></h2>

</article>

<?php
    endwhile;

    wp_reset_postdata();

else :
    echo '<p>No trainers found.</p>';
endif;

?>

</div>

<?php get_footer(); ?>