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

Não esqueça de acrescentar as linhas no seu composer.json
```
    "autoload": {
        "psr-4": {
            "App\\": "src/",
            "PhpConsole\\": "vendor/adrianodemoura/php_console/src/"
        }
    }
```   
e executar:
```
$ composer dump
```

Execute o exemplo 
```
$ vendor/adrianodemoura/php_console/bin/execute exemplo teste1 teste2
```

## Rodar Script
```
vendor/adrianodemoura/php_console/bin/execute script param1 param2 param3
```
