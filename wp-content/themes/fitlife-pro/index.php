<?php get_header(); ?>

<div class="container">

<?php

if (have_posts()) :

    while (have_posts()) :

        the_post();

        ?>

        <article>

            <h2>
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h2>

            <?php the_excerpt(); ?>

        </article>

        <?php

    endwhile;

else :

    echo '<p>No posts found.</p>';

endif;

?>

</div>

<?php get_footer(); ?>