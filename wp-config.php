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
define('DB_NAME', 'blog');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'password!12@');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         '94wP6^_;49?U4qgqa*ZVCM3y2gQ~3L0CrhtPlbZ=(GjAm-t)Fa^Nyb><8fO;;1j6');
define('SECURE_AUTH_KEY',  'F($} <bF~KQ8[!%3R>=FljaL_vM?QHY!^Z]RJfq=Z[M GF>eaF#Tv=4E1obxToYJ');
define('LOGGED_IN_KEY',    '0Z+6LTdT(==t+KqD@~:,r=BgX~h$%JHf+(tKwRLsc2Y^0Z1A6yMoGwe AVw6NjU*');
define('NONCE_KEY',        '|.|:_|O0^,Bo6}Rs|md3I~ 9-3t5D8c.a)uS0FtX%Q=+`,+qAwiOi1ZhZrxW6lc7');
define('AUTH_SALT',        '0{.xRp-ZT_-y(v|[VaF@>z7HVrEdjf9CR =i^8(oOqr6R^M>8%Gnf@!6-J]oz(!K');
define('SECURE_AUTH_SALT', ')bTXbe[-NmX*ZU#RtbP)IF*z|`*|2}|HG]`4w8Z>C7%y_$W[WkX@<sra/a#)4#Yo');
define('LOGGED_IN_SALT',   'Jxs&kVh%BO4;]JNeV%YyE}8SHl#JhV))tVQSvahRQo@{70PPJ=:qru68aDNJ9MZ2');
define('NONCE_SALT',       'D}q4l4vzpf.?3-sxMPo@S=%xL7LfXr4EPg0L};%jQP~Y,B@Mv=4s#Uk}rQ@8jL.,');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
