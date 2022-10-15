###################
Rotativo online
###################

*******************
Requisitos:
*******************
Ter um servidor rodando MySql e php versão 7+, recomendo o wamp caso não tenha nenhum.
Ter o composer instalado na sua máquina.
-  `Link Wamp <https://www.wampserver.com/en/download-wampserver-64bits/>`_
-  `Link composer <https://getcomposer.org/Composer-Setup.exe>`_

**************************
Passos
**************************

-  Baixar o projeto do gitHub
-  Renomear a pasta do projeto para 'software_rotativos'
-  Colocar a pasta do projeto no servidor, se for o Wamp é a pasta 'wamp/www' no disco do seu computador
-  Rodar no MySql o arquivo localizado em 'analise/ModelagemBancoDados.sql' no projeto, esse script contém a estrutura do banco de dados
-  Rodar no MySql o arquivo localizado em 'analise/BaseDeDados.sql' no projeto, esse script contém a os dados do banco de dados
-  A conexão do banco de dados que esta no projeto é a padrão do mysql do Wamp, para alterar abra no projeto o arquivo localizado em 'application/config/database.php' e altere a conexão default.
-  Abra um terminal de sua preferência na pasta do projeto, e execute os comandos localizado na pasta raiz do projeto chamado "comandos.txt"
-  Start o seu servidor, após startado acesse no navegador 'http://localhost/software_rotativos/'
