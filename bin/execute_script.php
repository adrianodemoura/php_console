<?php

if ( !defined('DIR_PHP_CONSOLE') ) define( 'DIR_PHP_CONSOLE', dirname( __DIR__ ) );
if ( !defined('DIR_APP') )
{
	if ( strpos( DIR_PHP_CONSOLE, 'adrianodemoura') > -1 )
		define( 'DIR_APP', str_replace( ['/adrianodemoura', '/php_console', '/vendor'], '', DIR_PHP_CONSOLE ) );
	else 
		define( 'DIR_APP', DIR_PHP_CONSOLE );
}

require DIR_APP . '/vendor/autoload.php';
require DIR_PHP_CONSOLE . '/src/Core/Config/bootstrap.php';
require DIR_PHP_CONSOLE . '/src/Core/Utility/global.php';

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

	$class 		= "\\PhpConsole\\Console\\{$scriptConsole}\\{$scriptConsole}";

    $script 	= new $class();

    $script->execute();

} catch ( Exception $e )
{
	switch ( $e->getCode() )
	{
		case 1:
			require DIR_PHP_CONSOLE . '/docs/help/help';
			break;
		case 2:
			error( 'error: '. $e->getMessage() );
			require DIR_PHP_CONSOLE . '/docs/help/missing_script';
			break;
		
		default:
			error('error: ' . $e->getMessage() );
			break;
	}
}