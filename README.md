# Desafio Feito Por Tayrone Martins - Developer Full stack

Resumo: Na raiz do projeto vera duas pastas (Back-Laravel-PHP e Front-react-js), o sistema originalmente foi desenvolvido com Laravel no seu back End e com ReactJs em seu Front End. O Sistema está com 100% dos requisitos pedidos! com as boas praticas de mercado introduzido no mesmo.


Como instalar: Como dito o sistema foi desenvolvido em Reactjs E Laravel, na Pasta "front-react-js" devera usar apenas o comando "npm install" e após ter instalado as dependências utilize do comando "npm start". Na pasta "Back-Laravel_PHP" devera utilizar dos seguintes comandos: "composer install" após ter instalado todas as suas dependências configure o arquivo ".env", observando que o baco de dados utilizado foi o Mysql, logo após ter configurado o arquivo ".env" digite o seguinte comando "php artisan key:generate", agora devera configurar o baco de dados com o "Migrate", no Laravel eu já configurei toda a parte de banco de dados com o migrate, devera apenas digitar
"php artisan migrate" isso montara todas as tabelas no banco de dados configurado no ".env", após ter feito todos esses passos podera subir o servidor digitando "php artisan serve" o front end se encontrara no local: 127.0.0.1:3000 e o back end em 127.0.0.1:8000.


PS: foi utulizado o php 7.2, e devera descomentar o PDO no arquivo php.ini!!



ATT, tayrone
          Martins
    Desenvolvedor Full - Stack
    



#------------------------------------------------------------------------------------------------------------------------------------------------------------------------------








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
  
  4- Quando o usuário enviar, deverá enviar o formulário por AJAX e salvar todas as informações em um banco de dados relacional contendo: **specialty_id, professional_id, name, cpf, source_id (GET /patient/list-sources), birthdate e date_time**.
      
  Obs: A listagem do campo "Como conheceu" deve vir da api (método ``GET /patient/list-sources`` )
  
  5- Após salvar as informações exibir uma informação ao usuário que os dados foram salvos.


## Tecnologias usadas

Os pré-requisitos para a aplicação:

- Use o PHP como linguagem backend, de preferencia a partir da versão 7.
- Usar Bootstrap ou qualquer framework front-end de sua preferência.
- Banco deve ser relacional, de preferencia MySQL
- Documentação sucinta e explicativa de como rodar seu código e levantar os ambientes.

## Avaliação

Para nos enviar seu código, você poderá escolher as 3 opções abaixo:

- Fazer um fork desse repositório e nos mandar uma pull-request
- Dar acesso ao seu repositório privado no Github ou Bitbucket para viniciusmaia.tx@gmail.com.
- Enviar um git bundle do seu repositório para os e-mail viniciusmaia.tx@gmail.com.

Caso opte por fazer um Pull-Request, deixe ele explicativo apontando tudo que precisa ser feito para rodar sua aplicação. 

## Dicas

- Aproveite os recursos das ferramentas que você está usando. Diversifique e mostre que você domina cada uma delas.
- Tente escrever seu codigo o mais claro e limpo possível. Código deve ser legível assim como qualquer texto dissertativo.
- Se destaque mostrando algo interessante e surpreendente. Isso sempre fará diferença.

Qualquer dúvida técnica, envie uma mensagem para viniciusmaia.tx@gmail.com.

Você terá 3 dias para fazer esse teste, a partir do recebimento deste desafio. Sucesso!
