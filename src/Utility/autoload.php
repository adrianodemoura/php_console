<?php
declare(strict_types=1);

function __autoload( $class )
{

	if ( strpos( $class, 'App\\' ) > -1 )
	{
		$_class		= str_replace( '\\', '/', $class );

		$arquivo 	= APP . DS . str_replace('App/', 'src/', $_class ) . '.php';
	}

	if ( !isset($arquivo) )
	{

		$arrClass = explode('\\', $class );

		$_arquivo = strtolower( $arrClass[0] ).DS.'src'.DS.$arrClass[1].DS.$arrClass[2].'.php';

		$scanDir = scandir( APP . DS . 'vendor' );

		foreach( $scanDir as $_l => $_dirVendor )
		{
			if ( in_array( $_dirVendor, ['.','..'] ) ) continue;

			$_arquivo = APP . DS . 'vendor' . DS . $_dirVendor . DS . $_arquivo;
			if ( file_exists( $_arquivo ) )
			{
				$arquivo = $_arquivo;
				break;
			}
		}
	}

	if ( file_exists( $arquivo ) )
	{
		require_once $arquivo;
	}
}
