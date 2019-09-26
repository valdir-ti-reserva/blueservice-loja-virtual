# docker

Exemplo Docker com Apache, MySql 8.0, PhpMyAdmin e Php

- Você pode utilizar o MariaDB 10.1 se você alterar a tag `mariadb-10.1`

- Você pode utilizar o MySql 5.7 se você alterar a tag `mysql5.7`

Utilize o docker-compose para rodar seus containers.

```
docker-compose up -d

```

Acesse o phpmyadmin em http://localhost:8000

Abra o browser em http://localhost:8001

Para acessar o cliente mysql:

- `docker-compose exec db mysql -u root -p` 

- Utilizar o arquivo loja.sql como dump para o banco loja

- Após realizar o dump acesse ao projeto normalmente

Enjoy !
