# FeeConsult - Tutorial de configuração de ambiente.

#### Este tutorial será dividido em 4 partes

- Instalação o XAMPP.
- Configuração do ambiente.
- Adicioando os arquivos.
- AWS - Sistema online -> [link](http://3.233.205.156/)

# 1 - Instalação o XAMPP!

  - Baixe o arquivo referente ao seu sistema operacional no link [XAMMP](https://www.apachefriends.org/pt_br/download.html)
  - Execute o instalador e clique em "next" até o processo terminar.

# 2 - Configuração do ambiente
#### 2.1 - Ajustes e Inicialização
  - Procure no directório de instalação a pasta php e abra o arquivo `php.ini` (Ex: C:\xampp\php)
  - Pesquise por `;extension=php_curl.dll`e remova o ";" do inicio.
  - Salve o documento e inicie o servidor clicando o aplicativo Xammp.
  - Assim que abrir o aplicativo, é necessário inicializar os serviços `Apache` e `MySQL`. Basta clicar em `Start` na coluna Actions.
#### 2.2 - Configurando o Banco de dados
  - Baixe a estrutura do banco neste link [BD](http://3.233.205.156/bd/feegow_agendamentos.sql) e salve como `feegow_agendamentos.sql`
  - Abra o `phpMyAdmin`, clicando no botão ADMIN no Xammp, e click em novo .
  - Nome da base de dados deve ser `feegow_agendamentos` e click em executar.
  - Click na base de dados recém criada e vá até o item `import`.
  - Arraste para a página ou selecione o arquivo `feegow_agendamentos.sql` baixado anteriormente.

# 3 - Adicionando os arquivos
  - Copie todos os arquivos deste repositório para a pasta `htdocs` do Xammp. 
  - A url de acesso vai depender do nome que der a pasta. Ex:   
    * Arquivos direto no htdocs: http://127.0.0.1/
    * Pasta feegow-challenge: http://127.0.0.1/feegow-challenge/
    
# 4 - Sistema online -> [http://3.233.205.156/](http://3.233.205.156/)
  - Acesso ao banco http://3.233.205.156/phpMyAdmin/
  - Usuário: `root`, senha: `t*x4J#GFpUgXAe3`

### Foram usados no projeto os itens abaixo:
 - [Bootstrap 4.5](https://getbootstrap.com/)
 - [Select2](https://select2.org/)
 - [Bootstrap Notif](http://bootstrap-notify.remabledesigns.com/)
 - [jQuery Mask](https://igorescobar.github.io/jQuery-Mask-Plugin/)
 
 Feito por Douglas Carvalho
