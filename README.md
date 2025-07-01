Sistema de Gestão de Estoque
Este é um sistema de gestão de estoque desenvolvido em PHP utilizando o framework Yii2 e PostgreSQL como base de dados. A aplicação foi construída seguindo a arquitetura MVC (Model-View-Controller) e princípios de orientação a objetos.

Funcionalidades Principais
    Autenticação Segura: Tela de login para o painel administrativo.

    Gestão de Produtos: CRUD completo para os produtos do estoque.

    Gestão de Usuários: CRUD completo para os utilizadores que podem acessar o sistema.

    Relatórios: Tela de relatório que exibe uma visão geral do estoque atual, incluindo valor total e quantidade de itens.

Tecnologias Utilizadas
    PHP
    Yii2 Framework (Advanced Template)
    PostgreSQL
    Composer

Guia de Instalação e Configuração
Siga os passos abaixo para instalar e executar o projeto no seu ambiente de desenvolvimento local.

Pré-requisitos
    Um ambiente de desenvolvimento PHP como o XAMPP ou Laragon (com PHP 8.1 ou superior).

    Composer instalado globalmente.

    PostgreSQL instalado e em execução.

    As extensões PHP pdo_pgsql, zip e intl devem estar ativas no seu ficheiro php.ini. Para ativar deve ser removido o ; da frente.

Passos de Instalação

1. Clonar ou baixar o Projeto
    Coloque todos os ficheiros do projeto numa pasta dentro do seu diretório web (ex: C:\xampp\htdocs\sistema-estoque).

2. Instalar Dependências
    Abra um terminal na pasta raiz do projeto e execute o Composer para instalar todas as dependências necessárias.

    composer install

3. Inicializar a Aplicação Yii2
    Execute o script de inicialização. Quando solicitado, escolha 0 para ambiente de desenvolvimento (development).

    php init

4. Configurar a Base de Dados

    Crie uma base de dados vazia no seu PostgreSQL (ex: estoque_db).

    Abra: common/config/main-local.php.

    Edite o componente 'db' com as suas credenciais do PostgreSQL (host, nome da base de dados, user e senha).

5. Executar as Migrações
    Este comando irá criar todas as tabelas necessárias (user e product) na sua base de dados.

    php yii migrate

    (Confirme com yes quando solicitado).

6. Criar o Primeiro user:
    Execute o comando abaixo para criar o user administrador do sistema. O terminal irá pedir-lhe para introduzir um nome de usuario, e-mail e senha.

    php yii user/create

7. (Opcional) popular tabela com dados de exmplo:
    Para testar o sistema com dados pré-inseridos, pode executar o seguinte comando para adicionar uma lista de peças automotivas de exemplo.

    php yii data/seed-products

Executar a Aplicação

1. Iniciar o Servidor Local
    Navegue para a pasta backend/web no seu terminal e inicie o servidor embutido do PHP.

    cd backend/web
    php -S localhost:8080

2. Acessar o sistema
    Abra o seu navegador e acesse o endereço:
    http://localhost:8080

Utilize as credenciais que criou no passo 6 para fazer login.