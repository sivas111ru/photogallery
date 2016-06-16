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
define('DB_NAME', 'photogallery');

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
define('AUTH_KEY',         '2fJ58h},??L!i&W iO&zT(kT!cW4|Df(:[5tHn_J)H HapouD ;O+LY}.)smT}?&');
define('SECURE_AUTH_KEY',  'w}as{4A:@G8BQUb[;jy~;u=Y%hOF!y(V7zpfy5nX[dqb<t,^dO,Q 1>RrM2aE`B#');
define('LOGGED_IN_KEY',    'h9!;&Ky@7,7%=zVxp$6K]B+,m9,@3 TE#ZV5%>2_`vJ0%pa?LzKK<s3eJ4;J|<N!');
define('NONCE_KEY',        ',Ag];V!frXlG[Lp|cnQBgeN~UPZHD#5AHJYty}j`H3b}sI6/k*t?BRw*F9V>bI(A');
define('AUTH_SALT',        'Df@rGl%%3%SkN{)mqi2(;vn$NFLe`Z5]dS!BIB;o(rD#Xf!Z;Of#(LIK+a:UK1Y^');
define('SECURE_AUTH_SALT', 'G<jtCf5<3W@&D%B^-*UW5qQ>n3gG[r,#`-?bXds)E[&bzYy&V_=bG!?..YLuby6-');
define('LOGGED_IN_SALT',   'pKUl[oA2Lh8v@I=jd8(.%3{3%o#F*/yWDB[#PmPf-i=)8kT.rny&@.F,6gu8m7M9');
define('NONCE_SALT',       '+qN8_LSB22Y4sV`!_w%612d^XFl#BWKiZQ1Sa}3/R2 ^:47w!BiPI<Isb1-0@~zC');

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
