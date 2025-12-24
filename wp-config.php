<?php

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', "u3225062_yar");

/** Database username */
define('DB_USER', "root");

/** Database password */
define('DB_PASSWORD', "");

/** Database hostname */
define('DB_HOST', "localhost");

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

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
define('AUTH_KEY',         '/b|aUx6__Z5;=@.u_Fvm9A}cVVc5p30|YlW$y;ib:onqaem57k5k7F<i(icYsFl9');
define('SECURE_AUTH_KEY',  ' ees9f%Y}+r,.M+=pJCWdTu]beBqk=0Mrf4s;.P>90BRb:^[7weP]T,#{&-%a^+(');
define('LOGGED_IN_KEY',    '>H_ecWD0reLDBc[S!HeMqr1pg3fp5Fzm?N .J?</9!L)k<+Sa$f=rB-P:AmGE.J/');
define('NONCE_KEY',        'b;qpoNRf|}q/{*O4qL-bq!%5K>8TUm1?%EJA+P^mpQa7WG=Y29Yd&I~EC6-cy.^<');
define('AUTH_SALT',        'R1iY;11a.ccz;k9,zHqjV2}VsKsYd$%`+p>W{LS#0d07uaCY[Tf=mwP2qx>Hn|hD');
define('SECURE_AUTH_SALT', '>nSO/#CT49;+m0:rpA$kT(&^4PSz0u6$eFfwAZ*:Zf)O|6j~kKi`C8lY8lra`~j8');
define('LOGGED_IN_SALT',   'yg kC&z#M!y/IgI mD!6!t@})z|t1Bb+}R%Gsp`z4u2Rwq`PBqs>d=4Q4xxO#UuG');
define('NONCE_SALT',       'l:CImNNW7Tosd3KC38Ji?Ecfv:y``+sz##F(h%LHXC{K/CJV0PZk%Y=|fWwwN_xs');

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */

/* Add any custom values between this line and the "stop editing" line. */

define('WP_DEBUG', true);

if (WP_DEBUG) {

        @error_reporting(E_ALL);

        @ini_set('log_errors', true);

        @ini_set('log_errors_max_len', '0');

        define('WP_DEBUG_LOG', false);

        define('WP_DEBUG_DISPLAY', false);
}

define('JWT_AUTH_SECRET_KEY', '6c1fc343e73772e042bfea418d28df2a7513d3bfee611ff2b98f3598814bcf65');
define('JWT_AUTH_CORS_ENABLE', true);
/* dev
 * prod
 * local
 */
define('WP_YAR_PROFILE_TYPE_APP', 'prod');

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (! defined('ABSPATH')) {
        define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
