# PhpConsole
Crie script PHP para rodar no console

## Instalação pelo composer
```
$ composer require adrianodemoura/php_console
```

## Criar Projeto
Execute o comando para criar o projeto
```
$ vendor/adrianodemoura/php_console/bin/create_app
```

Certifique-se que o arquivo `composer.json` possua a chave `autoload` como abaixo:
```
    "autoload": {
        "psr-4": {
            "App\\": "src/",
            "PhpConsole\\": "vendor/adrianodemoura/php_console/src/"
        }
    }
```   
Lembrese que toda vez que incluir algum projeto novo usando `compser require` é preciso executar:
```
$ composer dump
```

## Execute o exemplo 
```
$ bin/execute exemplo teste1 teste2
```

## Rodar Script
```
bin/execute script param1 param2 param3
```

## Criar novo script de console
```
bin/execute create_console nome_do_novo_script_console
```