<h1>Como rodar na sua máquina!</h1>
<ul>
    <li>Se certificar de ter Composer/Apache/Mysql instalados</li>
    <li>
        Em um terminal apontando para o diretorio do projeto, executar o seguinte comando
        ...
            composer install
        ...
    </li>
    <li>
        Em seguida, executar o comando:
        ...
            php artisan key:generate
        ...
    </li>
    <li>
        ...
            php artisan migrate --seed    
        ...
    </li>
    <li>
        ...
            php artisan serve
        ...
    </li>
    <li>
        Acessar localhost:8000
    </li>
</ul>
