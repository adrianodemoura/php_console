#!/usr/bin/php -q
<?php

define( 'DS', DIRECTORY_SEPARATOR );
define( 'APP', str_replace( ['/Utility', '/src', '/bin', '/adrianodemoura', '/vendor', '/php_console'], '', __DIR__ ) );

if ( is_dir(APP."/src/Console") )
{
	throw new Exception( "O Projeto já foi iniciado seu animal !");
}

// copy gitignore
exec("cp ".APP."/vendor/adrianodemoura/php_console/examples/project/.gitignore ".APP);

// create exemple console
exec("mkdir -p ".APP."/src/Console/Exemplo");
exec("cp ".APP."/vendor/adrianodemoura/php_console/examples/project/Exemplo.php ".APP."/src/Console/Exemplo");

// copy composer project
exec("cp ".APP."/vendor/adrianodemoura/php_console/examples/project/composer.json ".APP);

// update composer
$user 		= exec("whoami");
$dirBase 	= explode( DS, exec("pwd") ); 
$dirBase 	= end( $dirBase );
exec("sed -i 's/seu_usuario/$user/g' ".APP."/composer.json");
exec("sed -i 's/seu_projeto/$dirBase/g' ".APP."/composer.json");

// atualizando autoload
exec("composer dump");
