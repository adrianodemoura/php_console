# php_console
Crie script PHP para rodar no console

## Instalação pelo composer
```
$ composer require adrianodemoura/php_console
```

## Criar Projeto
Execute o comando para criar o projeto
```
$ vendor/adrianodemoura/php_console/bin/create_app.php
```

Certifique-se que o arquivo `composer.json` tem algo parecido como abaixo:
```
    "autoload": {
        "psr-4": {
            "App\\": "src/",
            "PhpConsole\\": "vendor/adrianodemoura/php_console/src/"
        }
    }
```   
Lemprese que toda vez que incluir algum projeto novo usando `compser require` é preciso executar:
```
$ composer dump
```

Execute o exemplo 
```
$ vendor/adrianodemoura/php_console/bin/execute.php exemplo teste1 teste2
```

## Rodar Script
```
vendor/adrianodemoura/php_console/bin/execute script param1 param2 param3
```
