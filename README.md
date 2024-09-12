# Como rodar na sua máquina:

1. Certifique-se de possuir `composer`, `apache`, `mysql` e `php 8.2 ou superior` instalados na maquina
2. Clone o repositório na sua máquina
3. Dentro do diretório do projeto faça uma copia do arquivo `.env.example` e renomeie para `.env`
4. Dentro do arquivo `.env` substitua os valores de `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME` e `DB_PASSWORD` de modo que entre de acordo com seu banco de dados
5. No terminal, dentro do diretório do projeto execute o comando para baixar todas as dependências:
   ```   
    composer install
   ```
6. Gere a chave da aplicação:
   ```
    php artisan key:generate
   ```

7. Execute as migrações e popule o banco de dados:
    ```
    php artisan migrate --seed
    ```
8. Inicie o servidor local:
    ```
    php artisan serve --port=8000
    ```
9. Agora basta acessar o sistema em: `localhost:8000`

## Autenticação
* Será criado um usuário inicial com cargo ADMIN, para se autenticar, utilize as seguintes credenciais:\
E-Mail: `admin@gmail.com`\
Senha: `admin`

## Rotas da API

1. Projetos
   ```
       GET /projects -> Lista todos os projetos
       GET /projects/create -> Exibe o formulário de criação de projeto
       POST /projects -> Armazena um projeto
       GET /projects/edit/{id} -> Exibe o formulario de edição de um projeto especificado pelo ID
       PUT /projects/{id} -> Atualiza um projeto
       GET /projects/{id} -> Exibe um projeto (e tarefas associadas) especificado pelo ID
       DELETE /projects/{id} -> Remove um registro de projeto especificado pelo ID
   ```
2. Tarefas
   ```
       GET /projects/{id}/tasks/create -> Exibe o formulario de criação de uma tarefa, associando a algum projeto especificado pelo ID
       POST /tasks -> Armazena uma tarefa
       GET /tasks/edit/{id} -> Exibe o formulario de edição de uma tarefa especificada pelo ID
       PUT /tasks/{id} -> Atualiza uma tarefa especificada pelo ID
       DELETE /tasks/{id} -> Remove um registro de tarefa especificada pelo ID
   ```
3. Usuários
   ```
       GET /users -> Lista todos os usuários cadastrados
       GET /users/register -> Exibe o formulário de cadastro de usuários
       POST /register -> Armazena um usuário
       GET /users/edit/{id} -> Exibe o formulario de edição de um usuário especificado pelo ID
       PUT /users/{id} -> Atualiza um usuário especificado pelo ID
       DELETE /users/{id} -> Remove um registro de usuário especificado pelo ID
   ```
