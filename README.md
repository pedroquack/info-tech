# Como rodar na sua máquina:

1. Certifique-se de possuir composer, apache, mysql e php instalados na maquina
2. Em um terminal apontando para dentro do diretório do projeto execute o seguinte comando:
   ```   
    composer install
   ```
3. Executar:
   ```
    php artisan key:generate
   ```

4. Executar:
    ```
    php artisan migrate --seed
    ```
5. Executar:
    ```
    php artisan serve --port=8000
    ```
6. Agora basta acessar localhost:8000

## Autenticação
* Será criado um usuário inicial com cargo ADMIN, para se autenticar utilizar as seguintes credenciais:\
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
