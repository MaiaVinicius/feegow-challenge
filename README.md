
# Feegow Challenge

## Instalação

É preciso ter o Docker com Docker Compose instalado.
O Docker Compose já vem no Docker Desktop para Windows e Mac, caso utilize Linux precisará instalar a parte.
- [Docker Compose](https://docs.docker.com/compose/install/)

Após clonar o repositório, basta rodar tudo com o docker compose, e acessar localhost:8000

Comando:
> docker-compose build && docker-compose up

## Informações

Foi utilizado Laravel como backend, e Vue.js no frontend.
Tenho trabalhado com Angular no dia a dia, e Laravel para construção de API,
 mas achei interessante conhecer melhor o Blade e o Vue.js.
Coloquei os builds e instalações de package managers dentro do docker file,
 assim daria menos trabalho a quem vai testar o sistema.
Coloquei também o dump.sql no momento do build para facilitar.
Obviamente não são práticas para um ambiente de produção.

