<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/content/11/7513811/html/2017/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'w0402a');

/** MySQL database username */
define('DB_USER', 'w0402a');

/** MySQL database password */
define('DB_PASSWORD', 'H20%17@n#');

/** MySQL hostname */
define('DB_HOST', 'w0402a.db.7513811.hostedresource.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'yI42JKhLqpWd^+1B|8g+p3*dOz9+AbLr67xE5exZD&RZnEbn9#CQLqVG8;bPCYys');
define('SECURE_AUTH_KEY',  '56")Cq7z0eSKW&4mxUedEm"NwiAheUcx"u9JkwW~f`Z`0WMAjWChYBr2eF4/@Ssc');
define('LOGGED_IN_KEY',    '(k*q5H7QN*Qqt"uN!KJQ5ZG$V+aB&L$:A(#NKOej;;E*19w):faj?+ki^bE)X1+6');
define('NONCE_KEY',        'zx|odPGl@GBh|@C3(q!Y6KyLY!!LNhB(O*"oc4K")0Mpyfl)6)Z;mwE6mXWl^DI)');
define('AUTH_SALT',        'Kzt1f%K6uyg3leVyf:z_oqKn49FUXNMkKHtRjS@S5BegbWYD5mTSf(lc#h)zsz?U');
define('SECURE_AUTH_SALT', 't"LxoqU6Ah8itfe|"gKJ(NuuWL1*JGi~~eV7&j?dD_JQs#%8CMD;dHM7B~Z02_hC');
define('LOGGED_IN_SALT',   'N72$RC|NO#vak%CSEpM|`5Orn0sd&+EvxR`g``x)&uJiqqhNP*0nRrqe5:Sq@FC:');
define('NONCE_SALT',       '0Nhx6jyt)k`nFPxTK5t)#1fHuhYB+KTw:2Dn++RM1&hjw3+qrTJhnQPo)b8F3z/Z');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'mnohq_';

/**
 * Limits total Post Revisions saved per Post/Page.
 * Change or comment this line out if you would like to increase or remove the limit.
 */
define('WP_POST_REVISIONS',  10);

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

