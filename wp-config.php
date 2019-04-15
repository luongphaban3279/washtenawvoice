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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '123' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Jf@FPuE&/x3@fK#/#8^W-n-Fj@?(Bc)PCXL5>EnTYe^tHj()D74U7~I9>{T;h1--' );
define( 'SECURE_AUTH_KEY',  'BsU ]X0#FNSChN2b(-fG`h._|O5a`Wq/^A~#|p]w)1*SAp9bk)^cU4}Bz9^%bdd0' );
define( 'LOGGED_IN_KEY',    'uqzIO%w$zdtiX.,)orxVG3[C*=,Rq_m3A)tr%l]`zY!WClu8nB`-/-dAlGx+e+p ' );
define( 'NONCE_KEY',        'Zcr`00@ZZ=a? KgOH(Nn?<pImd.]X%2o rhbb7X^Z;Bf|R|b?G 1S8PD*pZ!c&RB' );
define( 'AUTH_SALT',        'siCw:f!n6]hPe2 1(2T7[)$]r_v^1Ax0ZjO8[VY1NmCx6TTS,impLNf3sB~1yfXd' );
define( 'SECURE_AUTH_SALT', '9UvJ^hy#C<|cZ>&VFZDx+=;QTF0vefFd^43(%p~.:/%.UZ,:$B6N, =%/?VCgC}{' );
define( 'LOGGED_IN_SALT',   '=qDKh1<dT7Ar4dJtPX_q&)!~q(6}Wgh`D]w+}@wg_NPX_{_`,dmlIFovd$sz.?Kf' );
define( 'NONCE_SALT',       '#xcrVFd2:8}`=/V28C=1@%9;=@F@S]qyTuydY4%dM@%9Xj?/I=Jg1 4(!nHk,(5d' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
