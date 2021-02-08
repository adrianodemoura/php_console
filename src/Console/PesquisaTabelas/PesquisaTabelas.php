<?php
declare(strict_types=1);

namespace PhpConsole\Console\PesquisaTabelas;

use PhpConsole\Core\Console\Console;
use PhpConsole\Core\Database\Mysql;
use PDO;
use Exception;

class PesquisaTabelas extends Console {

	public function execute()
	{
		$config =
		[
			'host' 		=> 'localhost',
			'username' 	=> 'root',
			'database'	=> 'mysql',
			'password' 	=> ''
		];
		$nameLog 	= "lista_tabelas_do_banco_".$config['database'];
		$Mysql 		= new Mysql( $config );

		$arrTabelas = $Mysql->allTables();

		$this->search( $Mysql, $arrTabelas );
	}

	private function search(Object $Mysql, array $arrTabelas=[] )
	{
		$filtro 		= @$this->getParams()[0];
		$totalTabelas 	= 0;

		foreach( $arrTabelas as $_l => $_tabela )
		{
			$schema = $Mysql->getSchema( $_tabela );

			foreach( $schema as $_field => $_arrProp )
			{
				$sql = "SELECT * FROM $_tabela WHERE $_field LIKE '%$filtro%'";

				$result = $Mysql->query( $sql )->fetchAll( PDO::FETCH_ASSOC );
	
				if ( count( $result ) )
				{
					gravaLog( $result, "pesquisa_tabela_".$_tabela."_".count($result) );
					$totalTabelas++;
				}
			}
		}

		if ( $totalTabelas )
		{
			success("Total de tabelas pesquisadas: ".count($arrTabelas).", total que possuem algum campo com o valor \"$filtro\": $totalTabelas. Veja o resultado no diretório ".TMP);
		}
	}
}

