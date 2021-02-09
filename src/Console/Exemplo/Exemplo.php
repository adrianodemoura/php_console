<?php
declare(strict_types=1);

namespace PhpConsole\Console\Exemplo;

use PhpConsole\Core\Console\Console;

class Exemplo extends Console {

	public function execute()
	{
		gravaLog( $this->getParams(), 'resultado_script_exemplo' );

		success('veja o resultado em '.TMP.'/resultado_script_exemplo');
	}
}

