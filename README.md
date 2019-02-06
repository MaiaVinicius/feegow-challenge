# Feegow Challenge
Esse projeto foi feito baseado nos pré-requisitos do teste Feegow Challenge. Utilizando zend expressive, doctrine e o banco de dados relacional - Mysql

## Levantando ambiente
Antes de tudo tenha instalado em sua máquina o `docker` e `docker-compose`.

Após o processo acima.
Entre na raiz do projeto e inicialize os containers com o comando `docker-compose up`.

OBS: dependendo das condições da conexão e de sua máquina, esse processo pode levar alguns minutos

Após realizar os passos de levantar os containers com o comando acima, execute o seguinte comando dentro da pasta `projetoDesafio`: `docker exec -it php_web_feegow ./vendor/bin/doctrine orm:schema-tool:update --force`
Esse comando irá gerar a(s) tabela(s) no banco Mysql.

## Acessando o projeto
Para acessar entre na barra de endereço com essa url: `http://localhost:8100/`, porém você deve se certificar que a porta(8100) não está sendo utilizada.

## Dúvidas
Qualquer dúvida entre em contato com wallace.sf87@gmail.com
