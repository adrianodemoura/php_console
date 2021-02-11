<?php

namespace PhpConsole\Core\Utility;

class Inflector {

	public static function camelize( string $str='' )
	{
	    $i = array("-","_");
	    $str = preg_replace('/([a-z])([A-Z])/', "\\1 \\2", $str);
	    $str = preg_replace('@[^a-zA-Z0-9\-_ ]+@', '', $str);
	    $str = str_replace($i, ' ', $str);
	    $str = str_replace(' ', '', ucwords(strtolower($str)));
	    $str = strtoUpper(substr($str,0,1)).substr($str,1);

	    return $str;
	}

	public static function uncamelCase( string $str='' )
	{
	    $str = preg_replace('/([a-z])([A-Z])/', "\\1_\\2", $str);
	    $str = strtolower($str);

	    return $str;
	}
}