<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

<meta charset="<?php bloginfo('charset'); ?>">

<meta name="viewport" content="width=device-width, initial-scale=1">

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<a class="skip-link" href="#main-content">
    Skip to Content
</a>

<header class="site-header">

    <div class="container">

        <?php
        if (has_custom_logo()) {
            the_custom_logo();
        } else {
            echo '<h1>';
            bloginfo('name');
            echo '</h1>';
        }
        ?>

        <nav aria-label="Primary Navigation">

            <?php

            wp_nav_menu(array(
                'theme_location' => 'primary_menu',
                'menu_class'     => 'main-menu',
                'container'      => false,
               // 'walker'         => new FitLife_Walker()
            ));

            ?>

        </nav>

    </div>

</header>

<main id="main-content">