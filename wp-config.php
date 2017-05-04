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
define('DB_NAME', '123-blog.build');

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
define('AUTH_KEY',         'pax=@YpC|W4d@4n>)-g[vD=HUkm!nS6?]K5pp+B~8JDF6U8wGV/r)x9,,E*?KLd}');
define('SECURE_AUTH_KEY',  'R<{v0E[{&BU<2Q- sPkA$odMKDQ&pN#R1ing./D%9s6Rp:}h1]0or;s?|Ktl23I ');
define('LOGGED_IN_KEY',    'o[#Wzp,a^CQQz]b{yu5&RV>Oyz MUpA.=+sn<up?ILc&tN=g/uI+H3O0sIN!]qWE');
define('NONCE_KEY',        '5uU5O^f4G1uY39sRPu#<.F]nT`Il M#wSlFvNrSM(>*Xh{,Nw$_gB<vLmpFK[r65');
define('AUTH_SALT',        'C-/S`t|X<0zjO%`0c:O}hBzH)KX2LmB`ek,LHL5Wyr!I:w+I^hve{@j`w)@=Tg|6');
define('SECURE_AUTH_SALT', 'As-QUz~N]=LV*@p#B!?B1R,XKeBA:j}Q(1NHT}{Wx0dClkagX-ju}>i;P)t1G3z$');
define('LOGGED_IN_SALT',   'W`]I4k@UA0Tq %kO,mG#fKk.XqZi{*2 :;eUJFsta&}m-jouuU ?[/.kI`l,Z =K');
define('NONCE_SALT',       ',/p|D2%j~|+Ks]C(cLHse6<0OphMX9LzZL-8y812#[,ZRq]_v3C)yQ^bf&v!/}1T');

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
define('WP_DEBUG', TRUE);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
