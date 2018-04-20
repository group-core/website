<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'bpacapstonedb');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '-C7f^lStm2g*M1`s)GE#Jn;]D(QW/%XVzy1gHnK8%G)1dJW]3P(=Ve29t6!wfyf`');
define('SECURE_AUTH_KEY',  '#!rV?r95Z{[*7W-EAgZ[G`1&4%yXpeh5FyQI+omWfHGo1}[)fFdiy]A.?K2lVSHZ');
define('LOGGED_IN_KEY',    'j&n?b#d4323k`d{TWmM9%%xDo$7W&~IL;m3)h7q^w,)M6ueLL/l6=<SX YJLT^X(');
define('NONCE_KEY',        '.,3_wio]bu2`mk]HkdkRAE[<c&4yqBZQ9KE+pLHSJx%Htul$XUCvs^(}BHP[NT)c');
define('AUTH_SALT',        'J3(ToAfKmQyf)L#ki6r`kR|%$p _,-ae5.S6E/hmA9a!g{|rW$`J&z~[iSDjH^{*');
define('SECURE_AUTH_SALT', 'P SuwFP}:DCaL6:Sj>ufZ8Lr~^BS`gRuHq_a {fdnh>~uu_:YG2vz.5Q5lqmxP#-');
define('LOGGED_IN_SALT',   ':A99Z[|FI8bIdAv!1] z_eqL!p@sk]F!XX0,jS+.N|FUO]C,,d* nMEh6n$!3Tdq');
define('NONCE_SALT',       'MwV0C5vwW[^$W[y;1idfk[)}2PcbW6>8 X_cX-w*3IOx8L^2@CECV?Ky>n9W.1K0');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
