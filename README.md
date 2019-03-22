# Feegow Challenge

Esse é um teste que me avaliará para o cargo de desenvolvedor.
O teste consiste no desenvolvimento de um sistema que busque na api a listagem de médicos por especialização. 
Ao final deve-se registrar, em um banco de dados, o interesse no agendamento.

## Tecnologias usadas

- PHP
- Framework Laravel
- Banco de dados MySQL
- Bootstrap
- jQuery
- Composer
- Git

## Configurações

1- Configurar vHosts

    <VirtualHost *:80>
        ServerName feegow_challenge
        DocumentRoot "<WORKSPACE>\feegow_challenge\public"
        <Directory "<WORKSPACE>\feegow_challenge\public">
          AllowOverride all
        </Directory>
      </VirtualHost>
      
2 - Configurar apontamento no hosts. Para isso abrir arquivo hosts e inserir a linha:

    127.0.0.1   feegow_challenge

3- Criar banco de dados 

4- Configurar arquivo ``.env`` com os dados do Banco de Dados criado. Por ex:

    DB_CONNECTION=mysqlDB_HOST=localhost
    DB_PORT=3306
    DB_DATABASE=feegow
    DB_USERNAME=root
    DB_PASSWORD=root
  
5- Rodar o Migrate para que assim seja criado a tabela necessária para o sistema 

    php artisan migrate
    
Obs: Os dados para a conexão com a api (url, token), já encontram-se setados no arquivo  ``.env``, pois já haviam sido passados antes do teste.

6- Acessar http://feegow_challenge e avaliar meu esplêndido serviço.
  
