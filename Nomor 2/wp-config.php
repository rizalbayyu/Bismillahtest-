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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );
/** MySQL database username */
define( 'DB_USER', 'wpuser' );
/** MySQL database password */
define( 'DB_PASSWORD', 'akuganteng' );
/** MySQL hostname */
define( 'DB_HOST', 'localhost' );
/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );
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
define('AUTH_KEY',         'z[2qM4f3Li7:<Tt^=7bm]<.wN+ 0S :E*Bs>rDZkJaURNSIs6tx_5-=8AD)GA:@e');
define('SECURE_AUTH_KEY',  '|LU+mR<nAz+ -#JDbl1-.@ Mi8Q=~qM_X&G 49(>&+LJNR4uHn%CO/z]uS~hz|B{');
define('LOGGED_IN_KEY',    'jSbBO[H*bcm6k-SX}!L|NQcv K+_< l}7:/_-2*V0ANZs=C-a[P,eKU_e>ABR^0U');
define('NONCE_KEY',        '-4j`Jg1G[oQ!.ABO8B* #+yY;0BuI7rg|hW#GP [=cM9]}XE-cz7*Wwx6)C0:w(Y');
define('AUTH_SALT',        'YCh5l]{zpN1V(Z]`5GDCi3R|w+L4c)zx88<.gwN4CV+.EIb*UNOHawOG^aB#+|js');
define('SECURE_AUTH_SALT', 'kF7hl:xk7+nbW<1SzOA{k~]livl 7tY3~;lQwf9AM49OFE-H.?s6&]Vqo6Wu!-1z');
define('LOGGED_IN_SALT',   '%L5#2N07/A]hy,_qD84F>mu[k{.s~A[qf<l6h_D-`MJpy/bp?F_0Fu9tqd6<f5m$');
define('NONCE_SALT',       'Iae8h+1t-ysU|^J,_1#pJQ#A4EGZu>-2.8hT@?FeiElGm%g N/I^.tQ+,H3bskMN');
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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );
/* That's all, stop editing! Happy publishing. */
/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}
/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );