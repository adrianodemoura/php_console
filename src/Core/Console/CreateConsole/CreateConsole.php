<?php
declare(strict_types=1);

namespace PhpConsole\Core\Console\CreateConsole;

use PhpConsole\Core\Console\Console;
use PhpConsole\Core\Database\Mysql;
use Exception;

class CreateConsole extends Console {

	public function execute()
	{
		$scriptConsole = @$this->getParams()[0];

		if ( empty($scriptConsole) ) throw new Exception( "O Nome do novo console deve ser informado como parâmetro !" );

		if ( strlen($scriptConsole) < 6 ) throw new Exception( "O Nome do novo console deve ter ao menos 5 caracteres !" );

		$scriptConsole = camelize( $scriptConsole );

		exec( "mkdir -p ".DIR_PHP_CONSOLE."/src/Console/{$scriptConsole}");

		exec( "touch ".DIR_PHP_CONSOLE."/src/Console/{$scriptConsole}/{$scriptConsole}.php" );

		$this->createFileScript( $scriptConsole );

		success( "Novo Script Console \"{$scriptConsole}\" criado com sucesso." );
	}

	private function createFileScript( string $scriptConsole='' )
	{

		exec( "echo '<?php
declare(strict_types=1);

namespace PhpConsole\Console\\".$scriptConsole.";

use PhpConsole\Core\Console\Console;

class {$scriptConsole} extends Console {

	public function execute()
	{

		\$params = \$this->getParams();

		success(\"o novo script console ".$scriptConsole." foi criado com sucesso.\");

	}
}' > ".DIR_PHP_CONSOLE."/src/Console/{$scriptConsole}/{$scriptConsole}.php" );

	}

}