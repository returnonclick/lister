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
define('DB_NAME', 'photographer_db');

/** MySQL database username */
define('DB_USER', 'photographer');

/** MySQL database password */
define('DB_PASSWORD', 'Phot.918273');

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
define('AUTH_KEY',         '/vrcX+t|z[=Db6-T6Z!siH[|i}+.,z<m @sdfL<<_]tVo&xv0k[ 0$3e[34Q|(pH');
define('SECURE_AUTH_KEY',  'Aq|am<a5i5Z-2<~F=>8EA}Xf_D/4g4.:5|+fK-|F!bAMXTz *I=U-p3=tpHY|8U@');
define('LOGGED_IN_KEY',    '})_l{p&jBv2u>B^y<Zkgz&l(y?ed<XB=R.KGFlCtt3%-wT*V7YKQ]t9P%3A(0aCi');
define('NONCE_KEY',        'KSc0v[oOu`XU&oh3VpG{ ]k)B;UU8mVLHc||mS5{BIZTHF-Q{.H!cO m2/v@U:5/');
define('AUTH_SALT',        'llF/e5ceh4O_ARMT4y5+?|Fp~dE.?-8Is,gP5md_;jYYQf2@U&H~$;u|@lHJS9+>');
define('SECURE_AUTH_SALT', ')l|1e@H8#tb&ejuY.5?[[(>Q}I=-M+~Mh{5In1_e@mq%;;wGsT8I6|sp+MCsyM/]');
define('LOGGED_IN_SALT',   'S0z)##`|1Q_S F^gp7/APs,j2SGO%ryLD.yHZRAaQ;S0`pJ|OAtFl{5RI[}Th+T8');
define('NONCE_SALT',       'h}]_|hQp5x|[`@|`RQ7gc~2|;oaA)]m-PLL6J#vVTH/Q`+q|Q- MAO3A{ WTY~_#');

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
