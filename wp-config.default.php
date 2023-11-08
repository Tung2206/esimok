<?php

/**
 * Default config settings
 *
 * Enter any WordPress config settings that are default to all environments
 * in this file.
 *
 * Please note if you add constants in this file (i.e. define statements)
 * these cannot be overridden in environment config files so make sure these are only set once.
 *
 * @package    Studio 24 WordPress Multi-Environment Config
 * @version    2.0.0
 * @author     Studio 24 Ltd  <hello@studio24.net>
 */

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '?JyPW}N?Ffg-LpJ~S0*mI[ps=ZK6UBC8R*H~jzS Wp?J9SUr|{+vqfDSTXi8&9(i');
define('SECURE_AUTH_KEY',  '.x)gh4|BQY.r&yl*{HhX4^JedT%/l$U+Q&9u@}v``QGytvzjCvWn<}(x?=(;yw]_');
define('LOGGED_IN_KEY',    'HAa>6-^b8Cwhv44x)s>4]d)z|dCFH~4)D:{U^|gaalYVU]S]No~l#@slpiS<d.M~');
define('NONCE_KEY',        '$0C!+`z)7[*$Vzl_z/aZZus#F[%FjK^}g`Gi?-/p0nMzZDaS9`;5V)Pp@S|3-wSe');
define('AUTH_SALT',        'J:-P7pD~Y=awYzC;~A7z,!8lVe}Jn$=6UU[pbf=`cbMB%fgj+$tzWgi$dy`I0y$p');
define('SECURE_AUTH_SALT', 's-M[8>FUrElt}(^P)2NXN1lFbo8Qj:j|9CLdxI/t24}P&~!kttdAe(iCzrSKX+se');
define('LOGGED_IN_SALT',   '*o$:7l`=IB: ilFQ6:a!Dz2=S|< z+w3cUl~-JkC.6@eK[D6f:8Z_dE1SFBOEO(w');
define('NONCE_SALT',       ':a#CkZr`+#Cpj(}:Anyj:+<HVsw_e=ame|UVuLh7Y0$D^rA/):,>LRK1!/#R{x*@');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';
