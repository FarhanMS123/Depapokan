# Depapokan

## Installation

1. Duplicate `.env.example` to be `.env`
2. Setting the database cofiguration

```ENV
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=depapokan
DB_USERNAME=root
DB_PASSWORD=
```

3. Do this below in the terminal

```bash
$ composer install
$ php artisan migrate
$ php artisan storage:link
```

## References
- https://www.wahyunanangwidodo.com/2020/11/cara-install-bootstrap-di-laravel.html
- https://stackoverflow.com/a/4459419/5832341
