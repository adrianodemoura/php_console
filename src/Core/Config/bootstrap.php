<?php

if ( !defined('DIR_PHP_CONSOLE') ) define( 'DIR_PHP_CONSOLE', str_replace( ['/src', '/Core'], '', dirname( __DIR__ ) ) );

if ( !defined('DIR_APP') )
{
	if ( strpos( DIR_PHP_CONSOLE, '/vendor/adrianodemoura/php_console') > -1 )
		define( 'DIR_APP', str_replace( ['/vendor', '/adrianodemoura', '/php_console'], '', DIR_PHP_CONSOLE ) );
	else 
		define( 'DIR_APP', DIR_PHP_CONSOLE );
}

if ( !defined('TMP') )
{
	if ( is_dir( DIR_APP . '/tmp' ) ) 
		define( 'TMP', DIR_APP . '/tmp' );
	else
		define( 'TMP', '/tmp' );
}

if ( !defined('DS') )  define( 'DS', DIRECTORY_SEPARATOR );

