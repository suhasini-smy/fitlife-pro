</main>

<footer class="site-footer">

    <div class="container">

        <?php

        wp_nav_menu(array(
            'theme_location' => 'footer_menu'
        ));

        ?>

        <p>
            © <?php echo date('Y'); ?>
            <?php bloginfo('name'); ?>
        </p>

    </div>

</footer>

<?php wp_footer(); ?>

</body>
</html>