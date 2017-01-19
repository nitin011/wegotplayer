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
define('DB_NAME', 'weplayer');

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
define('AUTH_KEY',         '|0I}YXG?Sq@yLV%4zi&R5%Mv!nrg4+wZg)e!f)8H^6#u{|VG]4>rM-X_rec&*Rcd');
define('SECURE_AUTH_KEY',  'n-;B%!*xFoECXYvYn?+a9~)&<~6pOgW^KF5nG~Y2r9&ESc1s4=(4.mO4t5~8@=f8');
define('LOGGED_IN_KEY',    'g2mC0Lq#f6Ofg)IF#<K_B)/M~,wHMZHmJti!h@CirIC5H~/}3d!4<R!L<nxm5Uz)');
define('NONCE_KEY',        'O6k`ndT`svGh4FS.(+;qXQ8HDKaxn/7_k5`#WX_REJol]ENaq$jAIO8dF2G#LShc');
define('AUTH_SALT',        '6.wk{&K9R<dN[zy:|uVG.,ru}bA#Od]C1G3`yj/y2{|&0x{MLZc S^Zs)$xWdj/|');
define('SECURE_AUTH_SALT', 'YH09ryCe#c<R3dp|IDBlKsJIy(PUj2]&-CL|8>QsQ r=k^ZayioJKvn%$w.&3r.$');
define('LOGGED_IN_SALT',   '8_Ni9fdK(&uY_J0J7Nw7X*tUQV29(zQ}Z%{@ggf5OlTxeRv~!)=%Oyv|8cd7$N}p');
define('NONCE_SALT',       '9sUbKTk[EzxypNvf5lI)~dsx2cy<r?FOWT9V7AU*<IP 0sGXZu$PAa7F>!QLC>q;');

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
