#!/usr/bin/php -q
<?php

define( 'DS', DIRECTORY_SEPARATOR );
define( 'APP', str_replace( ['/Utility', '/src', '/bin', '/adrianodemoura', '/vendor', '/php_console'], '', __DIR__ ) );

// create temporary directory
exec("mkdir -p ".APP."/tmp");
exec("touch ".APP."/tmp/empty");
exec("echo \"tmp/*\n!tmp/empty\n\" > " . APP . "/.gitignore");

// create a simple example
exec("mkdir -p ".APP."/src/Console/Exemplo");
exec("touch ".APP."/src/Console/Exemplo/Exemplo.php");
$textoExemplo = "<?php
declare(strict_types=1);

namespace App\Console\Exemplo;
use PhpConsole\Console\Console;

class Exemplo extends Console {

	public function execute()
	{
		gravaLog( exec('whoami'), 'quem_sou_eu');

		success('See the result on the tmp directory.');
	}
}
";
exec("echo \"$textoExemplo\" > " . APP . '/src/Console/Exemplo/Exemplo.php');