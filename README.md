# Docker

#### Docker com Apache, MySql 8.0, PhpMyAdmin e Php

- Você pode utilizar o MariaDB 10.1 se você alterar a tag `mariadb-10.1`
- Você pode utilizar o MySql 5.7 se você alterar a tag `mysql5.7`

- Clone ou faça o download do projeto
- Rode o comando abaixo de dentro da pasta com o docker-compose

```php
docker-compose up -d

```



##### Acesse o phpmyadmin em http://localhost:8000



##### Abra a loja no link  http://localhost:8001/loja



##### Com o gerenciador de dependências Composer instalado: https://getcomposer.org/

Acesse o diretório em www/painel e em um terminal rode o comando:

- `composer install`



##### Então abra o painel administrativo em http://localhost:8001/painel




Para acessar o cliente mysql:

- `docker-compose exec db mysql -u root -p`

- Utilizar o arquivo loja.sql como dump para o banco loja

- Após realizar o dump acesse ao projeto normalmente



Enjoy !

