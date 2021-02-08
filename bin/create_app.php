#!/usr/bin/php -q
<?php

if ( !defined('APP') ) define( 'APP', str_replace( ['/Utility', '/src', '/bin', '/adrianodemoura', '/vendor', '/php_console'], '', __DIR__ ) );

require APP . '/vendor/adrianodemoura/php_console/config/bootstrap.php';


if ( is_dir(APP."/src/Console") )
{
	throw new Exception( "O Projeto já foi iniciado seu animal !", 1);
}

if ( exec("ls -1d ".APP." | wc -l") > 2 )
{
	throw new Exception("O Projeto já foi iniciado, é perigoso iniciar um novo !", 2);
}

// create bin directory
exec("cp -r ".APP."/vendor/adrianodemoura/php_console/examples/project ".APP);

// create tmp directory
exec("mkdir -p ".APP."/tmp");
exec("touch ".APP."/tmp/empty");
exec("setfacl -R -m g:www-data:rwX,d:g:www-data:rwX tmp/");

// update composer
$user 		= exec("whoami");
$dirBase 	= explode( DS, exec("pwd") ); 
$dirBase 	= end( $dirBase );
exec("sed -i 's/seu_usuario/$user/g' ".APP."/composer.json");
exec("sed -i 's/seu_projeto/$dirBase/g' ".APP."/composer.json");

// atualizando autoload
exec("composer dump");
