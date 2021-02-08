<?php

if ( !defined('DIR_PHP_CONSOLE') ) define( 'DIR_PHP_CONSOLE', str_replace( ['/src', '/bin', '/vendor'], '', __DIR__ ) );

if ( !defined('TMP') ) define( 'TMP', DIR_PHP_CONSOLE . '/tmp' );

if ( !defined('DS') )  define( 'DS', DIRECTORY_SEPARATOR );

