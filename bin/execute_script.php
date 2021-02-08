<?php

if ( !defined('APP') ) define( 'APP', str_replace( ['/src', '/bin', '/adrianodemoura', '/vendor', '/php_console'], '', __DIR__ ) );

require APP . '/vendor/autoload.php';
require APP . '/vendor/adrianodemoura/php_console/src/Core/Config/bootstrap.php';
require APP . '/vendor/adrianodemoura/php_console/src/Core/Utility/global.php';

try
{
	$scriptConsole = isset( $_SERVER['argv'][1] ) ? camelize( $_SERVER['argv'][1] ) : '';

	if ( in_array( strtolower( @$_SERVER['argv'][1] ), ['--help', '-h', '-help'] ) )
	{
		throw new Exception( 'printar ajuda', 1);
	}

	if ( empty($scriptConsole) )
	{
		throw new Exception("Script inválido", 2);
	}

	$class 		= "\\App\\Console\\{$scriptConsole}\\{$scriptConsole}";

    $script 	= new $class();

    $script->execute();

} catch ( Exception $e )
{
	switch ( $e->getCode() )
	{
		case 1:
			require APP . '/vendor/adrianodemoura/php_console/docs/help/help';
			break;
		case 2:
			error( 'error: '. $e->getMessage() );
			require APP . '/vendor/adrianodemoura/php_console/docs/help/missing_script';
			break;
		
		default:
			error('error: ' . $e->getMessage() );
			break;
	}
}