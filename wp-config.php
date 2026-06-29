<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'fitlife_db' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ')6?7?daj,:Q1d& nYzD1G~>LgXr#|M-RU#d2ZPytGK+#ppKml~rLC[-Nk<xDYd`0' );
define( 'SECURE_AUTH_KEY',  'NGj%^`6e.Oi,[v0zs?](<7e|bfMnl=WJaI,MTq&|tV;$v/hOj`dOam_*jMh3R5iP' );
define( 'LOGGED_IN_KEY',    'l&!TV;5-p%]Opx`:PaxDYMW9EQRM^gdQYz>r2L@TZA<i4*5Io}u,_b@a)DinW<L|' );
define( 'NONCE_KEY',        'K/i[dumb^Xi;MWYBM+!=WgG|E!-rb#I)SjOWz#~)IIf2QDAc4&7sYiY=p;Ety5+B' );
define( 'AUTH_SALT',        'Co8uYet}7rv2uygbj`T>]{XPJGk>VojRC?H7uFQnZ`k)C;%*}]}o*]UCDO:^NtCH' );
define( 'SECURE_AUTH_SALT', 'qYm<*W[ct[Qc7VqB|Qh*$#ZP!vU=%7T:T#>QR{K[sy/j0WwHSTLj.^p~[J[5n9Gv' );
define( 'LOGGED_IN_SALT',   '6yP6yA#W=QvgTcOg~4 +)/=ZDq_8bj-a*qzz]Z3y#-0c z{QE7aYrHK*3/5!Vwvb' );
define( 'NONCE_SALT',       'Al=ks7]DXsZnCYJx~,Rv]m%6n%T.db^*.rcZQd3sk-M%ubbN=vMS:. wYXjCo]>r' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );
// define('WP_DEBUG_LOG',false);
// define('WP_DEBUG_DISPLAY',false);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
