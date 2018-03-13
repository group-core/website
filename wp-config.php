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
define('DB_NAME', 'capstone');

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
define('AUTH_KEY',         'hHq;W0d#m?Bh*>fT`Ddc|yw_a@atQLOisO`>q<Z2%bq[y|_nklpk]Yu$+6XiJ4d]');
define('SECURE_AUTH_KEY',  '`?d/f^.A-zp`9xRS{@H<X{$O;7T{@,0-MxRoTd8!8&G|S8CxoT,!w{EX2f%2JxiB');
define('LOGGED_IN_KEY',    'ror~V0NSrhn#d_ir%1H0nzP`%l^/3Jyq~YD%OCC!w~@e23vyJ(t16L7lr4.xB[37');
define('NONCE_KEY',        '-M,CS|j~/b?[#YcJ }*05yTMojMf7-kw9Xj#Cu1{Td$sEApd_b0Q[k,_kE8 ,26s');
define('AUTH_SALT',        'G&kwM0#02^ehxl5%H`xv^;,<XnKxxAJ[&-X||&yPhw8U`dg]gtk-yS*070^DC%v:');
define('SECURE_AUTH_SALT', '@dLObM2z&Nd8WAPng&MmTJ85zomFmPQ:_Wkp3&|Y6lG<K!A3Mrzi6>o6e_)#4jA*');
define('LOGGED_IN_SALT',   'E,:}!)^Z5~r [_^j[LMC9B0TI/fxF#xu[w[g>!YkTwU~H38[,A0uM=h-,wGR2pGA');
define('NONCE_SALT',       '}zRcG>9%s+O9PUMDu3OZCC=}S8^GyL$xUw%a)X5!RG{I )LrtCF3Kjt,{7rj{0Yj');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'cp_';

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
