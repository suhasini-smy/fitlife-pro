<?php
get_header();
?>

<div class="container">

    <header class="search-header">
        <h1>
            <?php
            printf(
                esc_html__( 'Search Results for: %s', 'fitlife-pro' ),
                '<span>' . get_search_query() . '</span>'
            );
            ?>
        </h1>
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

        <p><?php esc_html_e( 'No results found.', 'fitlife-pro' ); ?></p>

    <?php endif; ?>

</div>

<?php
get_footer();