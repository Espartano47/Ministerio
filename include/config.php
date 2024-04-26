<?php

define( 'DB_HOST', 'localhost' );    // Set database host
define( 'DB_NAME', 'betel_miembros' );    // Set database name
define( 'DB_USER', 'root' );     // Set database user
define( 'DB_PASS', '' );        // Set database password

/* TimeZone */
date_default_timezone_set("America/New_York");    // UTC-4

session_write_close( );
session_start();

