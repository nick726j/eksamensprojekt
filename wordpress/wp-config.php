<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'apmedia2' );

/** Database username */
define( 'DB_USER', 'apmedia2' );

/** Database password */
define( 'DB_PASSWORD', 'cr2y@B195' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '~n2Y4!;MhH!-Ez&29Il>>ij$XXuA>E.Qz%!tnq;p+W]Y{q!<r9r]V@odJhSbD^[=' );
define( 'SECURE_AUTH_KEY',  'OJ`=S|)hBYIFK0oD]`J,>+W.eRcS++F+rvU@:JGa^Gbl<%$P.324q{$kRfv.W3)%' );
define( 'LOGGED_IN_KEY',    'qr00#TC`jIf>beROfspx*!7P_|U[ dIN#**JPWpcC4tv*C(/E>> @mqEcCnHL}mS' );
define( 'NONCE_KEY',        '>o<c!*lPmE~$KH#-,wLibPB%?H#<MTK%(CetW#8hx-r1?7?%((uj{!G2K}gDgu_i' );
define( 'AUTH_SALT',        'P@EdN15Q9BGv+,I+T`AePY v3V3%;H5q*dkWUy?d5{}bz<56+6Gs[AAKc*5Ijt,s' );
define( 'SECURE_AUTH_SALT', 'q}t2>j(j)=i(mm6Q}eD1_v(lW-q.|V/0HDf=R3T1`d87liMA.9(Y@10PfGb*A/.K' );
define( 'LOGGED_IN_SALT',   '.?YBw!1D=/re5I.1*UYLXJU/c,9ye8)z*E(jwy>?x/~3&*{>{8gu]yuvv;bS(I3/' );
define( 'NONCE_SALT',       '|,XeP]bsv^wrofa,3po}G0S3;BtK7?JW[8(T#Dw9k,Nqx;[F~JN.kdLl*CEGZq<$' );

/**#@-*/

/**
 * WordPress database table prefix.
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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
