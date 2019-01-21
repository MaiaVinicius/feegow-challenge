# Feegow Challenge

## Apresentação do projeto

Este simples projeto tem como núcleo a API da Feegow, de onde busca os dados, e insere os dados do formulário em um banco de dados relacional (MySQL) que representam um pedido de agendamento.

## Como levantar os ambientes

Tendo o `docker` e `docker-compose` instalados na máquina, basta executar o comando `docker-compose up -d`, que inicializa os containers (em segundo plano).
Certifique-se de que as portas 8081 e 3306 na sua máquina não estejam sendo utilizadas.

Após executar o comando, você terá 2 containers em execução. Um com o PHP (rodando o servidor integrado php -S) e outro com MySQL.

Para instalar as dependências do projeto em PHP, execute o comando `composer install`. Caso não tenha o `composer` na máquina, execute:

`docker --rm -it -v $(pwd):/project -w /project composer install`

Após realizar este passo, para criar o banco, execute:

```
docker exec -it {id_container_php} php bin/console doctrine:database:create
docker exec -it {id_container_php} php bin/console doctrine:migrations:migrate
```

Para encontrar o valor de `{id_container_php}`, execute `docker ps` e inspecione a saída.

## Executar o projeto

Após ter levantado os containers e criado a estrutura do banco, abra em seu navegador o endereço http://localhost:8081

A tela inicial exibe apenas uma select com as especialidades. Após selecioná-las, a lista de profissionais da especialidade será carregada.

Ao clicar em agendar com algum profissional, a tela de solicitação de agendamento será exibida, onde os dados enviados por este formulário são enviados para o banco de dados na tabela `formulario`

## Build do front (GULP)

Para poupar uma etapa do build, os arquivos minificados gerados pelo GULP foram versionados.

Caso queira editar os arquivos JS (assets/js), execute `npm install` para baixar as dependências do front, e depois execute `gulp` para realizar o build.

## Feedback

Em caso de dúvidas, erros, feedback ou tapinha nas costas, favor entrar em contato com carlosv775@gmail.com