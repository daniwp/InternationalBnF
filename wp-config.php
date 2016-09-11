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
define('DB_NAME', 'dwp_tornewssite1');

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
define('AUTH_KEY',         'cvIL#o.[0hHAu1oq:|2#E>i+%f:6f*j^`s5^NN*QHn`k@Ut=W1B.cc)gD-)l42*A');
define('SECURE_AUTH_KEY',  'LQilyWpbb.NB198kv>%8*YxUvl n(1-K;c@38$MX,H*}eo^yV[YQde.?&q_[C@My');
define('LOGGED_IN_KEY',    'w9-Fl+?j@ims`h%huC7co.5H}]*]h67RJ_Oktg&wu::@Eo*.|zSNQ1|4$fFg5Bw$');
define('NONCE_KEY',        'SVEjOtN*[x-riF8<P.*Qo-b.;q&2lnd{hz4oVO1uP6.)5eMVCN*+%^pZwE@fJuyl');
define('AUTH_SALT',        'aLig}[V5u+%8H5ok3]9U7NYyB-e(Sf3u;cn+2_ZjxbEu(dK5dRS-$(M1v8cFt3f8');
define('SECURE_AUTH_SALT', 'F&q:1,cG_Xz0f7+OQ+C4M0?|5PRk_Zg$AhBc<y`yvP<EcuiG4 L8l3%Z4h3E8).F');
define('LOGGED_IN_SALT',   '%u$$n]o7@jH2`h<Ur-,<]]iq]cXrI,jJ6Fzdc{tn.A@{?& =d2&6$NFL801j|}}#');
define('NONCE_SALT',       'oR/0IM+#-41egv&Jk$3%,)?WUhIH~ 3`DTfeTn)Z<%^tbKjb1}}&#yHjzRF@X-D~');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'dwp_';

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
