<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## How to Install

- Configurate .env file

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
