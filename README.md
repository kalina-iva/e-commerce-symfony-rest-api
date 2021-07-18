# Система управления товарами для площадки электронной коммерции

### Как поднять локально

- Установить symfony, composer, docker-compose

- docker-compose up -d

Из директории ./app
- composer install
- php bin/console doctrine:migrations:migrate
- symfony server:start (после запуска выдаст адрес, по которому запущен сервер, например, http://127.0.0.1:8000)

---

### Методы

#### Создание продукта 
**POST** http://`ip_server`/v1/product

#### Получение списка продуктов
**GET** http://`ip_server`/v1/product/page/{page}/limit/{limit}

#### Получение продукта по его id
**GET** http://`ip_server`/v1/product/{id}

#### Получение продукта по его sku
**GET** http://`ip_server`/v1/product/sku/{sku}

#### Изменение продукта по его id
**PUT** http://`ip_server`/v1/product/{id}

#### Изменение продукта по его sku
**PUT** http://`ip_server`/v1/product/sku/{sku}

#### Удаление продукта по его id
**DELETE** http://`ip_server`/v1/product/{id}

#### Удаление продукта по его sku
**DELETE** http://`ip_server`/v1/product/sku/{sku}

при создании и изменении продукта структура body

{
"sku": "sku-7",
"name": "product 7",
"type": "game",
"price": 123.98
}