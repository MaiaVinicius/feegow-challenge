# Tecnologias Utilizadas

Foi utilizado no back end PHP, Mysql, Zend Expressive e Doctrine. No front end ReactJS e Bootstrap.
Foi levantado também um banco a mais para executar os testes com PHPUnit.

# Para rodar a aplicação

Clonar o projeto.
``git clone https://github.com/mucapacheco/feegow-challenge.git``

Inicializar os submodulos.
``git submodule update --init``

Levantar o docker
``docker-compose -f docker/docker-compose.yaml up``

Baixar dependencias
``docker run --rm -it -v $(pwd):/feegow_challenge_back -w /feegow_challenge_back composer install``

Rodar PHPUnit
``docker exec -it feegow_challenge_back ./vendor/bin/phpunit --verbose --testdox --colors=always``


Após esses comandos, acessar ``http://localhost:8001/`` para rodar a instalação das tabelas no banco.

Após a instalação das tabelas acessar o Front End no endereço ``http://localhost:8002/``.

Obs. Verificar se as portas 8001 e 8002 estão disponíveis.
Criei a api para consultar os agendamento já relizados no endereço: ``http://localhost:8001/api/agendamento/findAll``


Para qualquer dúvida ou erros, entrar em contato pelo e-mail mucapacheco@hotmail.com.
