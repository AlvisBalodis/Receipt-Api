# Receipt-Api

**Receipt-Api** is a simple CRUD REST API built with PHP [Laravel](https://laravel.com/) framework.

Receipt have ``Id``, ``CreatedOn`` and ``Items`` fields.
``Items``– list of Receipt related items which contain ``ProductName`` fields.

### Installation

- Clone and open project in your preferred IDE.
- Then create the necessary database.

```php
php artisan db
```

```php
create database receipts
```

- And run the initial migrations and seeders.

```php
php artisan migrate --seed
```

- Run this command in project root folder. It will start localhost server.

```php
php artisan serve
```

- Open Chrome (The best UX) web browser, type and enter in address bar.

```php
localhost:8000
```

- Or better use [Postman](https://www.postman.com/) or other preferred API testing client.
