# Laravel Docker

### Configuração

1. Crie o seu projeto Laravel Docker em uma pasta de sua preferência:
>```sh
>$ composer create-project --prefer-dist daniloferreirasousa/laravel-docker seu_diretorio
>```

2. Crie uma cópia do arquivo .env.example para .env:
>```sh
>$ cp .env.example .env
>```

3. Atualize as variáveis de ambiente no arquivo .env:
```sh
APP_NAME="Nome do seu Projeto"
APP_URL=http://localhost:8001
APP_USER=user  // não usar espaços em branco
APP_UID=1000  // recomendado
```

4. Faça a criação do ambiente Docker:
>```sh
>$ docker-compose build --no-cache
>```

5. Inicie o container do seu Projeto:
>```sh
>$ docker-compose up -d
>```


6. Acessar o container app do seu ambiente criado:
>```sh
>$ docker-compose exec -it app bash
>```


7. Atualizar e instalar as dependências do projeto dentro do container app:
>```sh
>$ composer update
>```

8. Crie a key para o seu projeto Laravel:
>```sh
>$ php artisan key:generate
>```

Pronto após finalizar todos os passos listados acima, seu projeto deve estar pronto para ser acessado em: [http://localhost:8002](http://localhost:8002)
