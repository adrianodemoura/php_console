<?php
declare(strict_types=1);

namespace PhpConsole\Core\Console;

class Console {

	private $_params = [];

	public function __construct()
	{
		$arrParams  = $_SERVER['argv'];

	    $params     = [];

	    foreach( $arrParams as $_l => $_tag )
	    {
	        if ( $_l < 2 ) continue;

	        $params[] = $_tag;
	    }

	    $this->_params = $params;
	}

	protected function getParams()
	{
		return $this->_params;
	}
}