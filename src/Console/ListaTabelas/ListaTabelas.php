<?php
declare(strict_types=1);

namespace App\Console\ListaTabelas;
use PhpConsole\Console\Console;
use PhpConsole\Database\Mysql;
use Exception;

class ListaTabelas extends Console {

	public function execute()
	{
		$config =
		[
			'host' 		=> 'localhost',
			'database'	=> 'mysql',
			'username' 	=> 'root',
			'password' 	=> ''
		];
		$nameLog 	= "lista_tabelas_do_banco_".$config['database'];
		$Mysql 		= new Mysql( $config );

		$arrTabelas = $Mysql->allTables();

		gravaLog( $arrTabelas, $nameLog );

		success(" A lista de tabelas foi gravada em ".TMP."/$nameLog" );
	}
}

