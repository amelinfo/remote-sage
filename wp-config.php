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
define('DB_NAME', 'starter');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'j&a.;hhA-&^k7NIl[/}gYR2cztu+Eg%VC-P|~KMZ$;^xoC<eI EvWNS^orjgfHkz');
define('SECURE_AUTH_KEY',  '{639?JfjemD1IV 9!U}QXyDy&hFNkFIB!==^eHfe pmHbws~F9KThd4vW;V2c1U.');
define('LOGGED_IN_KEY',    'Nj,V*mZC5/c;V/44Hx>>MA4r<t_RXgjjS$~jD%qz~&~ljsfT`{9xwX]@@PRXBs@p');
define('NONCE_KEY',        '&pJW,AW,O^3V?V602>.eYRa[P<H1/ay:&EPZ)g`QH*|HrKC?]z4eh1[.c>NeXERA');
define('AUTH_SALT',        '[l+(Cc44Ipa]JiyRLc~LiLb2;~,aQ^k (A<JtT&yRNXQnq2aHXYCjZg6DWt!3+5K');
define('SECURE_AUTH_SALT', 'PUbn>P)<9Qt?c4xn.$itqk%NE_@Mw%&j]0PwIJL-w8:7BOD&S_[2YI4(sG]^(Moi');
define('LOGGED_IN_SALT',   '&SC-d,po:)p;mO*pyQwQER2kF9F^KY6ScaS:{Nz%{~n5=j c9}~vBcqiFts=SxZ=');
define('NONCE_SALT',       'JDVLIW<_Y)A|DQYMjB)DgO~CP>HK^phT1W38$ NH;S*nNNaKm<2]wB!::h0Joo&j');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'st_';

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
