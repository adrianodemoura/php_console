<?php
declare(strict_types=1);

namespace Rodar\Database;

class Field {

	public static function getTypeField( string $type='' ) : string
	{
		$typeField 	= $type;
		$position	= strpos( $type, "(" );

		if ( $position ) $typeField = substr( $type, 0, $position );

		return $typeField;
	}

	public static function getGeneralType( string $type='' ) : string
	{
		$generalType = 'string';

		if ( in_array( strtolower($type), ['numeric', 'int', 'tinyint', 'integer', 'float', 'double'] ) )
		{
			$generalType = 'numeric';
		}

		return $generalType;
	}
}