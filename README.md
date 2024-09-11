# Como rodar na sua máquina:

1. Certifique-se de possuir composer/apache/mysql/php instalados na maquina
Em um terminal apontando para dentro do diretório do projeto execute o seguinte comando:
   ```   
    composer install
   ```
2. Executar:
   ```
    php artisan key:generate
   ```

3. Executar:
    ```
    php artisan migrate --seed
    ```
4. Executar:
    ```
    php artisan serve --port=8000
    ```
5. Agora basta acessar localhost:8000

## Autenticação
* Será criado um usuário inicial com cargo ADMIN, para se autenticar utilizar as seguintes credenciais:\
E-Mail: `admin@gmail.com`\
Senha: `admin`
