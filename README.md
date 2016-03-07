# Edools para PHP

## Requisitos

* PHP 5.2+

## Instalação

Faça o download da biblioteca:

~~~
git clone https://github.com/edools/edools-php
~~~

Inclua a biblioteca em seu arquivo PHP:

~~~
require_once(".../edools-php/lib/Edools.php");
~~~

## Exemplo de Uso

~~~
Edools\Config::setApiKey("sua-chave-de-api-aqui");
Edools\Config::setEndpoint("http://your-school-api-endpoint.com");

$school = Edools\School::fetch("1");
$school->name;
~~~

## Documentação

Acesse [docs.edools.com](http://docs.edools.com) para referência.

## Testes

Instale as dependências. Edools-PHP utiliza SimpleTest.

~~~
composer update --dev
~~~

Execute a comitiva de testes:
~~~
php ./test/Edools.php
~~~

## To DO

- Adicionar mais recursos da API
- Adicioanr testes unitários
- Publicar biblioteca no Packagist


## Agradecimentos e créditos

Esta biblioteca inspirada na biblioteca [Iugu para PHP](https://github.com/iugu/iugu-php). Muito obrigado pelo ótimo código amigos.
