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
define('DISALLOW_FILE_MODS', true);

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wsisbxlx_ai2observatory');

/** MySQL database username */
define('DB_USER', 'wsisbxlx_ai2observatoryuser');

/** MySQL database password */
define('DB_PASSWORD', 'securese786');

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
define('AUTH_KEY',         'KQtX@/tpXD~Y+kiDL<4<-rTK@S:WY@I:%QCH%W }yFOns<frkj;kpmXi<9d}N4-~');
define('SECURE_AUTH_KEY',  'C;2fa_z?{OCBRkm,^*1<uf!h?Bb9Mi35c*r([;L]H!XN@b&Oc2T`{kqV}XlBO~Jc');
define('LOGGED_IN_KEY',    'ms,A_/0zX)Q[GG^xO|0d!D//0AsR6rk/=`g4>wI~Xu3}QT9+)L)^ewnxcc(t|PNm');
define('NONCE_KEY',        'Q7u)6JuehRK7]c2SHJ$`g.zZN}5j:wa?^0XGdxP$xq}Jnrq~6-pvO0$xVUe@i/HV');
define('AUTH_SALT',        'Xbi`h-d.S)cStqY^@8Dbqz}{<6~t-8@TMc/rs`x:9Sz_&V&)&FtA)<@QYSeAsHtY');
define('SECURE_AUTH_SALT', '&dX:lFt#_x.19;T4zic}Eu/XVTYv[lB}7ggI{W#3CXFR`5mX)jl%PM}Vo6C^@y:m');
define('LOGGED_IN_SALT',   '(GQ4uL$:vw73<6u1z39CqWqm1]}A@ (~~/muwpVq.8<[Lnx=419/yb429NAl}u&7');
define('NONCE_SALT',       'qDoKJn #m!<p<J2iQ.#&G&;7e`pa==zV}Kn}{>@2^xaulaqhPZf9V-{rNh_)(61k');

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
