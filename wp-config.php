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

// Load Composer’s autoloader
require_once (__DIR__.'/wp-content/vendor/autoload.php');

try {
    \Dotenv\Dotenv::createImmutable(__DIR__)->load();
} catch (Exception $e) {
    die('No .env found');
}

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME',  getenv('DB_NAME') );

/** MySQL database username */
define( 'DB_USER', getenv('DB_USER') );

/** MySQL database password */
define( 'DB_PASSWORD', getenv('DB_PASSWORD') );

/** MySQL hostname */
define( 'DB_HOST', getenv('DB_HOST') );

/** Database Charset to use in creating database tables. */
$charset = getenv('DB_CHARSET');
if ($charset) {
    define( 'DB_CHARSET', $charset );
} else if ($charset !== '') {
    define( 'DB_CHARSET', 'utf8' );
}

/** The Database Collate type. Don't change this if in doubt. */
$collate = getenv('DB_COLLATE');
if ($collate) {
    define( 'DB_COLLATE', $collate );
} else if ($collate !== '') {
    define( 'DB_COLLATE', 'utf8' );
}

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'VpAy)9,l?j)vVJPM>IV1ae~VR;i<0O5,B3XPsYJuhTsH^=j*7q2TsvBVTW _Udl;');
define('SECURE_AUTH_KEY',  'w!>15^#q8e|4/|[1BQ=6sDW:VJzvnI39 A?[/jiu+GvCYVo?gk/`l[RdB]%Lb=%T');
define('LOGGED_IN_KEY',    '.-[(;3N0UZD:^=UWR|zmDroAgm=[gSI8`r-YrC-kG /._+,:eNHgDfV(Za=J8Uad');
define('NONCE_KEY',        'IfK/N(GZ|~,;%wYhbZwdG.D]J[:$c0iq2.IQvigD3T,R[i|!D(`P7B6vsNbi!+^*');
define('AUTH_SALT',        ')eizB+)+E0<G..E]W=.1do|J|%viCvW||Zbrh*G-c0>87Qt+-XTIUpX1fG$;P(Ey');
define('SECURE_AUTH_SALT', 'sgJRu:?=l*#:WF(T,w9L-QdW03>Cd-M5JXFtBHX DU?u*x-A,|cG19RMkD];o0vh');
define('LOGGED_IN_SALT',   'ou83K5GmV|4$SG|`]i4|!pko*6-(|r@k {umQmjJ)T>m/|+CP<4JC-KWTn1`G)ub');
define('NONCE_SALT',       'g^6jBOoD,DgqE+v`veU%e4e*ZU)SnQLT/hR7v> alIt^ypO6Gcs1DGb[`%Bq*g`~');

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
define('WP_DEBUG', false);

define('DISALLOW_FILE_MODS', true);
define('DISALLOW_FILE_EDIT', true);
define('AUTOMATIC_UPDATER_DISABLED', true);
define('WP_AUTO_UPDATE_CORE', false);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/**
 * Define wp-content directory
 */
define('WP_CONTENT_DIR', dirname(__FILE__) . '/wp-content');
define('WP_CONTENT_URL', getenv('WP_CONTENT_URL'));

if(isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https') {
    $_SERVER['HTTPS'] = 'on';
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
