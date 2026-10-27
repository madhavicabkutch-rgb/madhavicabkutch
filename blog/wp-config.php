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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u903526733_f804P' );

/** Database username */
define( 'DB_USER', 'u903526733_5mIwC' );

/** Database password */
define( 'DB_PASSWORD', ';PZ(v}.fo3' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          '<{g$,c6)QY2E1$^#13Qr;9x`3Z/9K|q>TZPkt95,?[g:_V>upp(+;[yLg3Y[cC3J' );
define( 'SECURE_AUTH_KEY',   'At/Jll2Ff{6vdo#(yjYe(}v^Ru8-2$Mc|jlD5bOT#`1(T,tP56^!fz2.Ge;Yk?eA' );
define( 'LOGGED_IN_KEY',     'I V-=iAJiVE>]B#87$T<63Wb[?6-VWG~CbY4#piE5~@e,x>`9`qmhG552;sf3gBi' );
define( 'NONCE_KEY',         '/.gCy+YnY@(5j/RbR9qnq+tuf RA4qrs[1@&frWft1R^lqk&58rGWx]-E20J3a7h' );
define( 'AUTH_SALT',         '2j^&0I#O78bW.2W!Rn?wj@G>Zy0PQ.%ixl3(jmH3*)<dcnch|V(pwXL5Au$KIoIa' );
define( 'SECURE_AUTH_SALT',  'IF`x!Lc`!2~Aaj?ZLOzTJ-{t4b4D_p[e5#PKIK&P&a<`m>beB.1:!YD_|ZT[F}A1' );
define( 'LOGGED_IN_SALT',    '<OUD9NS`c&1gw4,nRQ>wo+:3k5=!:t|K4G;c|,R.!AU>w_MBgPysv}V~7g]k;JY>' );
define( 'NONCE_SALT',        'NtH>|HIYix}KWcn=a%rbjKM%n?b|7DcXg&686>2_Irm?RNKL+S0hX7))H5igDKze' );
define( 'WP_CACHE_KEY_SALT', 'A?/T>~`[^v/=]*|~%8(qx|!J}Kf(,+]W+j|+Pui@u%G5?AUFrFE+s|z$mA>>sf~K' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'FS_METHOD', 'direct' );
define( 'COOKIEHASH', '68bdb8bf5427d7188492848215bd65ad' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
