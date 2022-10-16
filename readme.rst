###################
Rotativo online
###################

*******************
Requisitos:
*******************

-  Ter um servidor rodando MySql e php versão 7+, recomendo o wamp caso não tenha nenhum. `Link Wamp <https://www.wampserver.com/en/download-wampserver-64bits/>`_
-  Ter o composer instalado na sua máquina. `Link composer <https://getcomposer.org/Composer-Setup.exe>`_

**************************
Passos
**************************

-  Baixar o projeto do gitHub
-  Renomear a pasta do projeto para 'software_rotativos'
-  Colocar a pasta do projeto no servidor, se for o Wamp é a pasta 'wamp/www' no disco do seu computador
-  Importar no MySql o arquivo localizado em 'analise/ModelagemBancoDados.sql' no projeto, esse script contém a estrutura do banco de dados
-  Importar no MySql o arquivo localizado em 'analise/BaseDeDados.sql' no projeto, esse script contém a os dados do banco de dados
-  A conexão do banco de dados que esta no projeto é a padrão do mysql do Wamp, para alterar abra no projeto o arquivo localizado em 'application/config/database.php' e altere a conexão default.
-  Abra um terminal de sua preferência na pasta do projeto, e execute os comandos localizado na pasta raiz do projeto chamado "comandos.txt"
-  Start o seu servidor, após startado acesse no navegador 'http://localhost/software_rotativos/'

**************************
Tutorial pra Importar a estrutura e dados do banco de dados (Wamp)
**************************

-  1° Abra o arquivo 'analise/ModelagemBancoDados.sql' no projeto e copie tudo
-  2° Com o Wamp ja startado, abra no seu navegador 'http://localhost/phpmyadmin/'
-  3° No menu superior clique em SQL, ira abrir um campo pra digitar
-  4° Cole nesse campo o script copiado no passo 1
-  5° Clique no botão "Executar" no canto inferior
-  6° Repita o processo para o arquivo 'analise/BaseDeDados.sql'

**************************
Observações
**************************

-  Caso tenha problema com instalação do composer, o projeto ainda irá rodar sem erros, com exceção dos relatorios em PDF