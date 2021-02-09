<?php
declare(strict_types=1);

namespace PhpConsole\Console\NaoDesceCanalizada;

use PhpConsole\Core\Console\Console;

class NaoDesceCanalizada extends Console {

	public function execute()
	{
		// parâmetros
		$params = $this->getParams();

		success("o novo script console NaoDesceCanalizada foi criado com sucesso.");

	}
}
