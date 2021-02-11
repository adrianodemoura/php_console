<?php

require dirname( __DIR__ ) . '/Config/bootstrap.php';

use PhpConsole\Core\Utility\Inflector;

try
{
	$scriptConsole = isset( $_SERVER['argv'][1] ) ? Inflector::camelize( $_SERVER['argv'][1] ) : '';

	if ( in_array( strtolower( @$_SERVER['argv'][1] ), ['--help', '-h', '-help'] ) )
	{
		throw new Exception( 'printar ajuda', 1);
	}

	if ( empty($scriptConsole) )
	{
		throw new Exception("Script inválido", 2);
	}

	// src
	$arquivo 	= DIR_PHP_CONSOLE . "/src/Console/{$scriptConsole}/{$scriptConsole}.php";
	if ( file_exists( $arquivo ) )
	{
		$class = "\\PhpConsole\\Console\\{$scriptConsole}\\{$scriptConsole}";
	} else
	{
		// plugin
		$arquivo = DIR_PHP_CONSOLE . "/src/plugins/{pluginName}/src/Console/{$scriptConsole}/{$scriptConsole}.php";
		if ( !file_exists( $arquivo ) )
		{
			// Core
			$arquivo = DIR_PHP_CONSOLE . "/src/Core/Console/{$scriptConsole}/{$scriptConsole}.php";
			if ( !file_exists( $arquivo ) )
			{
				throw new Exception( "Não foi possível localizar o script {$scriptConsole}");
			}
			$class = "\\PhpConsole\\Core\\Console\\{$scriptConsole}\\{$scriptConsole}";
		}
	}

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