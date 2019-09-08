<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## How to Install

development

- Set develop params .env file.
```ini
APP_NAME=%Site name%
APP_ENV=local
APP_KEY=%php artisan key:generate%
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=%database%
DB_USERNAME=%username%
DB_PASSWORD=%password%

```


- Run migration 
```bash
php /path/to/artisan migrate
```

- Add to cron(crontab) file
```cron
* * * * * php /path/to/artisan schedule:run >>/dev/null 2>&1
```

- Install product.dump.sql

## About

- / - homepage
- /login - login
- /admin - adminpanel

## Used

- 


## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
