## Laravel Fake Shop

Laravel + Vue.js shop example. 

- Laravel native auth and register
- Products are automatically generated
- Realtime currency switch: EUR, USD, BRL. Provided by [ECB](http://www.ecb.europa.eu).
- Simple CRUD for orders
- Email notification when order is created
- Vue router
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).

## Instalation

Composer dependencies:

```
composer install
```
Node dependencies:

```
npm install
```
Generate secret key:

```
php artisan key:generate
```

Setup database in the file `.env`:

```
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=fake-shop
DB_USERNAME=user
DB_PASSWORD=secret
```

Setup email sending. ([Mailtrap](https://mailtrap.io) provides this free and easy)

```
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=null
```

Run migrations and seeders (product generation).

```
php artisan migrate --seed
```

Run application

```
php artisan serve
```

