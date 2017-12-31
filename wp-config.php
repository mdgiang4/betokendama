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
define('DB_NAME', 'betokendama');

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
define('AUTH_KEY',         '3pr68qJ&.#U Ks>/jjOsUR,&U:?zVfLt=SdgL3cmX^%bs5/0]|L5F$sp;gK^|k#j');
define('SECURE_AUTH_KEY',  'Y_7a=DpDSqe:I/P()u~wltzrINYTw$!-&Vx2LJ*T{m90TQR!RYc@x@z|@6/eY5sf');
define('LOGGED_IN_KEY',    'wmFVk-6X>wP/l@D&uqS[~H:$G-Q394vm&.P@r=A~y-`twrTSYtECh!Tu<n[8J7.{');
define('NONCE_KEY',        '>r%,ByYURaFTwQ&F!!W]Pz8==$.Q>nX)Ll!E@=pK0kN]r[Cn)O50EkwPX$T+xOP[');
define('AUTH_SALT',        '`uS6Bh,i4tlUs-^|6~dvg*%:.q!I$fT0WU;*,ZlrlFicGub& fkqC`4|]>h@5Ez?');
define('SECURE_AUTH_SALT', 'sP*&(FM*YaF}Hqqy4,o$=s:T)gk=;24T/eh+*Lq?_3qL{KYigW#*MDu#4kA.NY2w');
define('LOGGED_IN_SALT',   'P2]l<e-J)<8bqzW5N(th^@Uk~wq6B7phiO#^*~8Y#fuPS%S$P8^RaZTqY5q`)1Iq');
define('NONCE_SALT',       'ZwWy54 4fo1{_9*T^M+SUUaR/i(+@iQk+</hQlVMRFv9Qw)Ca~e{`uqc::30C>U2');

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
