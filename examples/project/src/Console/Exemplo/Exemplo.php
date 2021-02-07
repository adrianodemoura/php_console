<?php
declare(strict_types=1);

namespace App\Console\Exemplo;
use PhpConsole\Console\Console;

class Exemplo extends Console {

	public function execute()
	{
		gravaLog( $this->getParams(), 'parametros' );

		success('veja o resultado do script no diretório tmp');
	}
}

