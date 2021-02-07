#!/usr/bin/php -q
<?php

define( 'DS', DIRECTORY_SEPARATOR );
define( 'APP', str_replace( ['/Utility', '/src', '/bin', '/adrianodemoura', '/vendor', '/php_console'], '', __DIR__ ) );

if ( is_dir(APP."/src/Console") )
{
	throw new Exception( "O Projeto já foi iniciado seu animal !", 1);
}

if ( exec("cat composer.json | grep 'adrianodemoura/php_console' | wc -l") > 0 )
{
	throw new Exception("O Compośer já foi atualizado, a instalação de novo projeto não pode continuar.", 2);
}

exec("cp ".APP."/vendor/adrianodemoura/php_console/examples/project/.gitignore ".APP);

// create tmp directory
exec("mkdir -p ".APP."/tmp");
exec("setfacl -R -m g:www-data:rwX,d:g:www-data:rwX tmp/");

// create exemple console
exec("mkdir -p ".APP."/src/Console/Exemplo");
exec("cp ".APP."/vendor/adrianodemoura/php_console/examples/project/Exemplo.php ".APP."/src/Console/Exemplo");

// copy composer project, if not exists
exec("cp ".APP."/vendor/adrianodemoura/php_console/examples/project/composer.json ".APP);

// update composer
$user 		= exec("whoami");
$dirBase 	= explode( DS, exec("pwd") ); 
$dirBase 	= end( $dirBase );
exec("sed -i 's/seu_usuario/$user/g' ".APP."/composer.json");
exec("sed -i 's/seu_projeto/$dirBase/g' ".APP."/composer.json");

// atualizando autoload
exec("composer dump");
