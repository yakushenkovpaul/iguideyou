<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //


/**
*  The name of the database for WordPress
*/
define('DB_NAME', 'iguideyou_tours');

/**
*  MySQL database username
*/
define('DB_USER', 'iguideyouuser');

/**
*  MySQL database username
*/
define('DB_PASSWORD', 'gtgtcLA3@');

/**
*  MySQL hostname
*/
define('DB_HOST', 'localhost');

/**
*  Database Charset to use in creating database tables.
*/
define('DB_CHARSET', 'utf8');

/**
*  The Database Collate type. Don't change this if in doubt.
*/
define('DB_COLLATE', '');

/**
*  WordPress Database Table prefix.
*  You can have multiple installations in one database if you give each a unique
*  prefix. Only numbers, letters, and underscores please!
*/
$table_prefix = 'wp_';

/**
*  disallow unfiltered HTML for everyone, including administrators and super administrators. To disallow unfiltered HTML for all users, you can add this to wp-config.php:
*/
define('DISALLOW_UNFILTERED_HTML', false);

/**
*  
*/
define('ALLOW_UNFILTERED_UPLOADS', false);

/**
*  The easiest way to manipulate core updates is with the WP_AUTO_UPDATE_CORE constant
*/
define('WP_AUTO_UPDATE_CORE', true);

/**
*  forces the filesystem method
*/
define('FS_METHOD', 'direct');

/**
*  Authentication Unique Keys and Salts.
*  Change these to different unique phrases!
*  You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
*  You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
*  @since 2.6.0
*/
define('AUTH_KEY', '*9EfXB4Vm|;j=?M|.A1h._Yp<O?]d0!+1Q`Sz_R0[SD3b(/}bJ >|ixpR /ux 6+');
define('SECURE_AUTH_KEY', 'HKyZ*f]!Z!o!-?AM-_rJ&uy|UAU@0]/63xnR]Jfb0b;W|$k7;+?x^U=M ;Gyx<LY');
define('LOGGED_IN_KEY', '(<~$7)yPy22E@k@zWmEG+Y]+S#O5n#S#KAkw^lH +l-M;w[}HQ>UzQNar|Fu.WIE');
define('NONCE_KEY', '4n`bl$`Fa-{M5s%n81b#0c.#g[{q; :dgp5LPux[0O:Vu2!>CJke9Y->a:yJ]c?}');
define('AUTH_SALT', '*-%#gN!`^1,S0]jamBoAgSwNUQ9-wIC#tuG/|F~`WEc*ZAv|9E~K+,6#8NBBW2h$');
define('SECURE_AUTH_SALT', '!J,6>*g,SOVJ@7-dXkL+!.ThMu,Tg?;+{Meu=t<B:`&4k,]-9U3!Hovz&fx2MsV3');
define('LOGGED_IN_SALT', ')99sj(o};i=?i`i1[+p3loq962Y,Vxt8d^;qE18Axi?]/ml{ELWUZ$7pJ?3{J^3<');
define('NONCE_SALT', '8sfP*<z}r -vvR=Icru9OR|%2ZDF7?A3i+h.5Hl+tcAJz+66N*ty@gC>)boN<ZzU');

/**
*  For developers: WordPress debugging mode.
*  Change this to true to enable the display of notices during development.
*  It is strongly recommended that plugin and theme developers use WP_DEBUG
*  in their development environments.
*/
define('WP_DEBUG', false);
define('WP_DEBUG_LOG', false);
define('WP_DEBUG_DISPLAY', true);

/**
*  For developers: WordPress Script Debugging
*  Force Wordpress to use unminified JavaScript files
*/
define('SCRIPT_DEBUG', false);

/**
*  WordPress Localized Language, defaults to English.
*  Change this to localize WordPress. A corresponding MO file for the chosen
*  language must be installed to wp-content/languages. For example, install
*  de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
*  language support.
*/
define('WPLANG', 'es-ES');

/**
*  Where to load language's file
*/
define('WPLANG_DIR', 'es');

/**
*  Enable Multisite for current Wordpress installation
*/
define('MULTISITE', true);

/**
*  Use sub domains for network sites
*/
define('SUBDOMAIN_INSTALL', true);

/**
*  Multi Site Domain
*/
define('DOMAIN_CURRENT_SITE', 'iguideyou.tours');
#define('NOBLOGREDIRECT', '' );
#define('WP_HOME', 'http://iguideyou.tours');
#define('WP_SITEURL', 'http://iguideyou.tours');


/**
*  Multi Site Current Root path
*/
define('PATH_CURRENT_SITE', '/');

/**
*  Multi Site Current site Id
*/
define('SITE_ID_CURRENT_SITE', 1);

/**
*  Multi Site current Blog Id
*/
define('BLOG_ID_CURRENT_SITE', 1);

/**
*  Memory Limit
*/
define('WP_MEMORY_LIMIT', '64M');

/**
*  Post Autosave Interval
*/
define('AUTOSAVE_INTERVAL', 60);

/**
*  Disable / Enable Post Revisions and specify revisions max count
*/
define('WP_POST_REVISIONS', true);

/**
*  this constant controls the number of days before WordPress permanently deletes 
*  posts, pages, attachments, and comments, from the trash bin
*/
define('EMPTY_TRASH_DAYS', 30);

/**
*  Make sure a cron process cannot run more than once every WP_CRON_LOCK_TIMEOUT seconds
*/
define('WP_CRON_LOCK_TIMEOUT', 60);

/**
*  Cookies Hash
*/
define('COOKIE_DOMAIN', 'iguideyou.tours');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
