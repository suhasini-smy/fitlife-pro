<?php
get_header();
?>

<div class="container">

    <header class="archive-header">
        <h1><?php the_archive_title(); ?></h1>
        <?php the_archive_description(); ?>
    </header>

    <?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <h2>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h2>

                <?php the_excerpt(); ?>

            </article>

        <?php endwhile; ?>

        <?php the_posts_pagination(); ?>

    <?php else : ?>

        <p><?php esc_html_e( 'No posts found.', 'fitlife-pro' ); ?></p>

    <?php endif; ?>

</div>

<?php
get_footer();