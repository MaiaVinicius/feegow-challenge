# Overview do Projeto
1- O projeto é um "mini clone" do site da Feegow, foram adicionada as funcionalidades propostas no desafio. O resultado final está disponível para visualização em https://www.gbtechweb.com.br/feegow

2- O projeto foi desevolvido sem uso de frameworks PHP e nem CSS, foi totalmente desenvolvido em PHP, HTML, CSS e jQuery com Ajax.  


## Instalação do Projeto
1- Existe um arquivo de banco de dados que se encontra na pasta "database" já pronto para ser instalado,
2- Subir o projeto para algum servidor Apache como "Xampp" e configurar a URL BASE em "_app/Config/Config.inc.php",
3- Os arquivos desenvolvidos para o teste se encontram na pasta "themes/feegow/index.php", "themes/feegow/js/scripts.js" e "themes/feegow/_ajax/feegow.ajax.php"


# Feegow Challenge

Esse é um teste focado em design de código, e conhecimento de orientação a objeto. O objetivo é avaliar sua experiênica em escrever código de fácil manutenção, baixo acoplamento, e alta coesão.


## Apresentação do problema

A clínica _Exemplo_ precisa exibir a listagem de seus médicos separados por especialidade em seu site para que seus pacientes tenham acesso. Essa clínica utiliza o Feegow que possui toda a api necessária para isso. 
Link da documentação: https://api.feegow.com.br/api/documentation 

  1- A tela inicial deve ser um SELECT contendo a listagem de todas as especialidades que a clínica trabalha (método na documentação: ``GET /specialties/list``). 
  
  ![Exemplo do SELECT](https://image.prntscr.com/image/krKCLaZGT1O3rf4h4ETLow.png)
  
  
  2- Quando o usuário escolhe uma especialidade, é executado um AJAX para buscar os profissionais que possuem aquela especialidade e exibido em tela (método na documentação: ``GET /professional/list``). 

  ![Exemplo do SELECT](https://image.prntscr.com/image/v4cm7l99TOuvcyhHuIgaJw.png)

  3- Quando o usuário clica em "AGENDAR", será exibido um formulário que o usuário irá preencher e clicar em "ENVIAR".
  
  ![Exemplo do SELECT](https://image.prntscr.com/image/w34r0YIUQsmlJcq7DcaIQA.png)
  
  4- Quando o usuário enviar, deverá enviar o formulário por AJAX e salvar todas as informações em um banco de dados relacional contendo: **specialty_id, professional_id, name, cpf, source_id (GET /patient/list-sources), birthdate e date_time**.
      
  Obs: A listagem do campo "Como conheceu" deve vir da api (método ``GET /patient/list-sources`` )
  
  5- Após salvar as informações exibir uma informação ao usuário que os dados foram salvos.


## Tecnologias usadas

Os pré-requisitos para a aplicação:

- Use o PHP como linguagem backend.
- Usar Bootstrap ou qualquer framework front-end de sua preferência.
- Banco deve ser relacional, de preferencia MySQL/POSTGRESQL
- Documentação sucinta e explicativa de como rodar seu código e levantar os ambientes.

## Avaliação

Para nos enviar seu código, você poderá escolher as 3 opções abaixo:

- Fazer um fork desse repositório e nos mandar uma pull-request
- Dar acesso ao seu repositório no Github para viniciusmaia@feegow.com.br.
- Enviar um git bundle do seu repositório para os e-mail viniciusmaia@feegow.com.br.

Caso opte por fazer um Pull-Request, deixe ele explicativo apontando tudo que precisa ser feito para rodar sua aplicação. 

## Dicas

- Aproveite os recursos das ferramentas que você está usando. Diversifique e mostre que você domina cada uma delas.
- Tente escrever seu codigo o mais claro e limpo possível. Código deve ser legível assim como qualquer texto dissertativo.
- Se destaque mostrando algo interessante e surpreendente. Isso sempre fará diferença.

Qualquer dúvida técnica, envie uma mensagem para viniciusmaia@feegow.com.br.

Você terá 3 dias para fazer esse teste, a partir do recebimento deste desafio. Sucesso!
