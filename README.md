# BlueClinic

Essa é uma aplicação de teste de conhecimentos para Feegow. A clínica BlueClinic exibe a listagem de seus médicos separados por especialidade e faz assim a solicitação de horários.

## Configurando ambiente para utilização da aplicação

- Fazer o pull desse repositório
- Configurar as variáveis de ambiente(servidor, banco de dados)
- Fazer a migração da tabela para o banco de dados
- Utilizar a aplicação

NOTA: antes de fazer o upload dessa aplicação foi utilizado como parâmetro tecnologias não usuais para produção, apenas para desenvolvimento, isto é, foi utilizada a ferramenta XAMPP para a instalação e configuração do servidor e banco de dados.

## Utilizando a aplicação

Para utilizar a aplicação é bem simples, basta seguir os seguintes passos abaixo: 

  1- Na tela inicial do Projeto(Pagina home), você deve selecionar qual a especialidade desejada e clicar em "Buscar". 
  
  ![Exemplo do SELECT](https://upsorteios.com/imgs/home.png)
  
  
  2- Quando o passo 1 for executado, irá abrir uma nova página contendo todos os profissionais da especialidade desejada, basta então escolher o profissional desejado e clicar em "Agendar". 

  ![Exemplo do SELECT](https://upsorteios.com/imgs/buscaResult.png)

  3- Ao final do passo 2, irá aparecer o seguinte modal, onde você irá preencher com suas informações e clicar em "Solicitar horários".
  
  ![Exemplo do SELECT](https://upsorteios.com/imgs/infoPerson.png)
  
  4- Automaticamente ao conluir o passo 3, você irá receber uma mensagem de sucesso e será redirecionado para a página onde se encontram as solicitações, página a qual também pode ser acessada por meio da "Navbar".

  ![Exemplo do SELECT](https://upsorteios.com/imgs/solicitacao.png)


## Tecnologias usadas

Os pré-requisitos para a aplicação:

- PHP como linguagem backend utilizando o Laravel Framework.
- Bootstrap.
- Banco MySQL.
- Jquery.

NOTA: antes de fazer o upload dessa aplicação foi utilizado como parâmetro tecnologias não usuais para produção, apenas para desenvolvimento, isto é, foi utilizada a ferramenta XAMPP para a instalação e configuração do servidor e banco de dados.

## Manutenção da aplicação

Para a manutenção da aplicação, está descrito antes de cada função seu objetivo e comportamento, mantendo assim uma fácil identificação e manutenção do código.

