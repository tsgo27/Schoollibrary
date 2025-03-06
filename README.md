# School Library - Sistema de Gestão de Biblioteca Escolar

O Sistema foi desenvolvido para facilitar e otimizar o gerenciamento de livros, tornando o processo de empréstimo e devolução mais ágil e eficiente para alunos. Além disso, o sistema conta com um dashboard intuitivo que apresenta indicadores de quantos livros estão reservados, emprestados, e também o status dos alunos (ativos ou inativos), proporcionando uma visão clara e prática.

![Screenshot_1](https://github.com/user-attachments/assets/d106ef30-22fd-4d91-8433-296fa8fa0c67)


##

![img-home](https://github.com/user-attachments/assets/f7a82bb4-580e-4b56-86a3-4824a936b81b)


---

## Tecnologia Utilizada no Projeto

- **Linguagem de Programação**: PHP  
- **IDE Utilizada no Desenvolvimento**: Visual Studio Code  
- **Banco de Dados**: MySQL  
- **Back-End**: PHP  


---

## Funcionalidades Configuradas

O sistema já vem com as seguintes funcionalidades configuradas e prontas para uso:

✅ **Proteção CSRF**: O sistema possui proteção contra CSRF, garantindo a segurança nas requisições feitas pelo usuário.
  
✅ **Bloqueio de Login**: O sistema registra tentativas de login, se um usuário errar mais de 5 vezes, o acesso é bloqueado por 5 minutos, prevenindo ataques de força bruta.

✅ **Controle de Acesso**: O sistema também permite o bloqueio de contas de usuários, seja por motivo de férias ou qualquer outra razão. Isso garante que apenas usuários autorizados tenham acesso ao sistema, mantendo o controle de segurança e evitando acessos indevidos.
  
✅ **URLs Amigáveis**: As URLs do sistema são amigáveis e facilitam a navegação.
  
✅ **Página de Erro 403**: Caso o usuário tente acessar uma página sem permissão, será exibida uma página de erro 403.
  
✅ **Página de Erro 404**: Caso a página solicitada não seja encontrada, o sistema exibe uma página de erro 404 personalizada.
  
✅ **Página de Erro de Conexão com Banco de Dados**: Caso haja falha na conexão com o banco de dados, o sistema exibirá uma página de erro específica. Além disso, o arquivo `.env` permite habilitar o modo de debug para exibir os erros diretamente na página de erro de conexão, facilitando a identificação do problema.

✅ Registro de Logs de Erros: O sistema agora captura e registra automaticamente erros em um arquivo de log, facilitando a identificação e resolução de problemas. Os erros são gravados com data, hora e detalhes do ocorrido, proporcionando um monitoramento mais eficiente e uma manutenção mais ágil.

✅ Log de Requisições POST: Foi implementado um novo arquivo de logs chamado requests, onde é possível visualizar todas as requisições do tipo **POST** feitas na aplicação. Cada requisição é registrada com informações detalhadas dos valores passados, parâmetros enviados e resposta do servidor, garantindo maior transparência e rastreabilidade no sistema.


---

## Autores

- [Jakeline Macedo da Silva](https://www.linkedin.com/in/jakeline-silva-80635398/)
- [Tiago Soares da Conceição](https://www.linkedin.com/in/tsgo27/)
- [Vanessa da Silva Santos](https://www.linkedin.com/in/vanessa-da-silva-santos-50688b227/)


---

## Licença
Copyright © 2023 School Library.

Este projeto é licenciado [MIT](https://choosealicense.com/licenses/mit/)
