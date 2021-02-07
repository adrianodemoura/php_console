#!/usr/bin/php -q
<?php

declare(strict_types=1);

define( 'DS', DIRECTORY_SEPARATOR );

define( 'APP', str_replace( ['/Utility', '/src', '/bin', '/adrianodemoura', '/vendor', '/rodar'], '', __DIR__ ) );

$dirUtility = dirname(__DIR__);

include_once $dirUtility . '/src/Utility/autoload.php';
include_once $dirUtility . '/src/Utility/global.php';

try
{
	$scriptConsole = isset( $_SERVER['argv'][1] ) ? camelize( $_SERVER['argv'][1] ) : '';

	if ( empty($scriptConsole) ) { throw new Exception( "script inválido"); }

	$class 		= "\\App\\Console\\{$scriptConsole}\\{$scriptConsole}";

    $script 	= new $class();

    $script->execute();

} catch ( Exception $e )
{
	error( $e->getMessage() );
}
