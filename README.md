# Feegow Challenge

Esse é um teste focado em design de código, e conhecimento de orientação a objeto. O objetivo é avaliar sua experiênica em escrever código de fácil manutenção, baixo acoplamento, e alta coesão.

## Apresentação do problema

A clínica _Exemplo_ precisa exibir a listagem de seus médicos separados por especialidade em seu site para que seus pacientes tenham acesso. Essa clínica utiliza o Feegow que possui toda a api necessária para isso. 
Link da documentação: https://clinic.feegow.com.br/components/public/api/documentation 

  1- A tela inicial deve ser um SELECT contendo a listagem de todas as especialidades que a clínica trabalha (método na documentação: ``GET /specialties/list``). 
  
  ![Exemplo do SELECT](https://image.prntscr.com/image/krKCLaZGT1O3rf4h4ETLow.png)
  
  
  2- Quando o usuário escolhe uma especialidade, é executado um AJAX para buscar os profissionais que possuem aquela especialidade e exibido em tela (método na documentação: ``GET /professional/list``). 

  ![Exemplo do SELECT](https://image.prntscr.com/image/v4cm7l99TOuvcyhHuIgaJw.png)

  3- Quando o usuário clica em "AGENDAR", será exibido um formulário que o usuário irá preencher e clicar em "ENVIAR".
  
  ![Exemplo do SELECT](https://image.prntscr.com/image/w34r0YIUQsmlJcq7DcaIQA.png)
  
   3.1- Quando o usuário enviar o formulário, salve todas as informações em um banco de dados relacional contendo: **especialidade_id, profissional_id, nome, cpf, como_conheceu_id, nascimento e data_hora**.


## Tecnologias usadas

Os pré-requisitos para a aplicação:

- Use o PHP como linguagem backend, de preferencia a partir da versão 7.
- Usar Bootstrap ou qualquer framework front-end de sua preferência.
- Banco deve ser relacional, de preferencia MySQL
- Documentação sucinta e explicativa de como rodar seu código e levantar os ambientes.

## O que gostaríamos de ver (se der tempo)

- Uso de um framework MVC PHP (Laravel, CodeIgniter, Symphony, etc)
- Teste unitários.
- Pre-processadores de front (Gulp, Grunt ou Webpack).
- Aplicação rodando em Docker Containers.
- CRUD completo e funcional, primeiramente da entidade Formulário, e Usuários como um plus.

## Avaliação

Para nos enviar seu código, você poderá escolher as 3 opções abaixo:

- Fazer um fork desse repositório e nos mandar uma pull-request
- Dar acesso ao seu repositório privado no Github ou Bitbucket para educostachaves@gmail.com e  viniciusmaia.tx@gmail.com.
- Enviar um git bundle do seu repositório para os e-mail educostachaves@gmail.com e viniciusmaia.tx@gmail.com.

Caso opte por fazer um Pull-Request, deixe ele explicativo apontando tudo que precisa ser feito para rodar sua aplicação. 

## Dicas

- Aproveite os recursos das ferramentas que você está usando. Diversifique e mostre que você domina cada uma delas.
- Tente escrever seu codigo o mais claro e limpo possível. Código deve ser legível assim como qualquer texto dissertativo.
- Se destaque mostrando algo interessante e surpreendente. Isso sempre fará diferença.

Qualquer dúvida técnica, envie uma mensagem para viniciusmaia.tx@gmail.com.

Você terá 3 dias para fazer esse teste, a partir do recebimento deste desafio. Sucesso!
