<?php
get_header();
?>

<div class="container">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <h1><?php the_title(); ?></h1>

            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'large' ); ?>
            <?php endif; ?>

            <div class="content">
                <?php the_content(); ?>
            </div>

        </article>

    <?php endwhile; endif; ?>

</div>

<?php
get_footer();