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

### Usando Composer

~~~
$ composer require edools/edools
Please provide a version constraint for the edools/edools requirement: 0.1.0
~~~

O autoload do composer irá cuidar do resto.

## Exemplo de Uso

~~~
Edools::setApiKey("c73d49f9-6490-46ee-ba36-dcf69f6334fd");
~~~

## Documentação

Acesse [docs.edools.com](http://docs.edools.com) para referência

## Testes

Instale as dependências. Edools-PHP utiliza SimpleTest.

~~~
composer update --dev
~~~

Execute a comitiva de testes:
~~~
php ./test/Edools.php
~~~

## Agradecimentos e créditos

Esta biblioteca foi altamente inspirada na biblioteca [Iugu para PHP](https://github.com/iugu/iugu-php). Somos gratos pelo código muito bem escrito.
