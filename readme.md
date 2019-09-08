<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## Установка

Последовательно выполнить следующие комманды:

```bash 
git clone https://github.com/Blezigen/test-work-06_09_2019.git

-- Вместо test.work.example своё название папки
mv test-work-06_09_2019 test.work.example

-- Вместо test.work.example своё название папки
cd test.work.example

-- Настроить переменные окружения в файле .env
-- APP_DEBUG=false
-- APP_URL=http://test.work.example
-- APP_NAME=TestExample
cp .env.example .env

-- Подтянуть зависимости
composer install

-- Сгенерировать уникальный ключ приложения
php artisan key:generate

-- Подключить папку storage
php artisan storage:link

-- Запуск миграций с начальными данными
php artisan migrate --seed

-- Заппуск инициализации продуктов
php artisan db:seed --class=ProductsTableSeeder

-- Создание пользователя с правами администратора
php artisan admin:create-user

-- Добавить запись в cron. Где /path/to/artisan - полный путь до файла artisan
* * * * * php /path/to/artisan schedule:run >>/dev/null 2>&1
```
