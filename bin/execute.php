#!/usr/bin/php -q
<?php

if ( !defined('DS') )  define( 'DS', DIRECTORY_SEPARATOR );
if ( !defined('APP') ) define( 'APP', str_replace( ['/Utility', '/src', '/bin', '/adrianodemoura', '/vendor', '/php_console'], '', __DIR__ ) );
if ( !defined('TMP') ) define( 'TMP', APP.'/tmp' );

require APP . '/vendor/autoload.php';
require APP . '/vendor/adrianodemoura/php_console/src/Utility/global.php';

try
{
	$scriptConsole = isset( $_SERVER['argv'][1] ) ? camelize( $_SERVER['argv'][1] ) : '';

	if ( empty($scriptConsole) ) exit( "script inválido");

	$class 		= "\\App\\Console\\{$scriptConsole}\\{$scriptConsole}";

    $script 	= new $class();

    $script->execute();

} catch ( Exception $e )
{
	error('error: ' . $e->getMessage() );
}