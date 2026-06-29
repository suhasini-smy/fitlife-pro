<?php get_header(); ?>

<section class="hero">

    <div class="container">

        <h1>Transform Your Body Today</h1>

        <p>Professional fitness programs and trainers.</p>

        <a href="/trainers" class="btn">
            Meet Trainers
        </a>

    </div>

</section>


<section class="featured-trainers">

<div class="container">

<h2>Featured Trainers</h2>

<?php

$args = array(
    'post_type' => 'fitlife_trainer',
    'posts_per_page' => 3
);

$query = new WP_Query($args);

if ($query->have_posts()) :

    while ($query->have_posts()) :

        $query->the_post();

        ?>

        <article>

            <?php the_post_thumbnail(); ?>

            <h3><?php the_title(); ?></h3>

        </article>

        <?php

    endwhile;

    wp_reset_postdata();

endif;

?>

</div>

</section>

<?php get_footer(); ?>