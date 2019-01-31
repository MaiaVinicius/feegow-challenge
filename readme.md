    

## Feegow Challenge

O projeto foi realizado em PHP utilizando o framework Laravel.

## Instruções de instalação




Partindo do princípio que  o PHP e MySQL estão instalados, basta navegar até o diretório do projeto e executar a sequencia abaixo:

- Renomear o arquivo .env.example para .env e configurar o mysql (DB_HOST, DB_DATABASE, DB_USERNAME e DB_PASSWORD) e a url(APP_URL)
- Entrar no mysql e criar o banco de dados (create database foobar por exemplo)
- Conceder permissão 777 na pasta storage (chmod 777 storage -R)
- Rodar o comando php artisan key:generate para gerar a chave criptografada
- Rodar o comando php artisan migrate para gerar as tabelas no banco de dados
- Rodar o comando php artisan serve para levantar o servidor(acessar através da url http://127.0.0.1:8000)

##Feedback


Em caso de dúvidas, erros ou feedback, favor entrar em contato com hygino.thiago@gmail.com