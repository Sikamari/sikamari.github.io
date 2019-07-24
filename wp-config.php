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
define( 'DB_USER', 'elupin' );

/** MySQL database password */
define( 'DB_PASSWORD', 'kmzwa8awaa' );

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
define( 'AUTH_KEY',         '5z?NTqJOmJ@+4gc:<~xy[Y|k,,k`_1Ud=  ToBht(uqjqi!a]8Xg}4F3`;RnwB0A' );
define( 'SECURE_AUTH_KEY',  'GI|J*HJ@YT+7!TFK?>06%twNdgj+j|U2mKYP;n4e?SuV[mw>q4e]T^%i}8-Y]=6C' );
define( 'LOGGED_IN_KEY',    ')9PeY]#vQru<]9HQElCKiX@E<9wnXvXY[2}Sr3~X1@ItQT._e,jAQV$araq~`WJj' );
define( 'NONCE_KEY',        's=guDNyWM1=PIRre;|=78u0ev+;<WjYONn##k5i{}&0Owj:Xl_{-%u&Lymu@<yS>' );
define( 'AUTH_SALT',        'HQ~0e%6{ldS`Rx`Om.7lN$IMUc+-A<tH?c*4SOLr;lIbm/mf}K^!Z5=vv|rTR;ry' );
define( 'SECURE_AUTH_SALT', 'v k .YE.Z},MS=A7OX<z--wVL%R~Zxms`{EB-ut2i: zH]P}[Wj*Z6u?n_!bn1-N' );
define( 'LOGGED_IN_SALT',   'PHoebKf<Jp3$;|ym+UcS(x~Y!3Uy,@tn)Ppg)GXaeH6IfD$2u>[Ros.1`D@sR/%<' );
define( 'NONCE_SALT',       ';gCtOS<pjj7X}!nOD-QE,uyWpVUo1#TJ,07>DhC/y|2#Nyn> H,fK^o55x%92{;]' );

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
