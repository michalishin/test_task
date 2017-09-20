## Start
```bash
git clone git@github.com:michalishin/test_task.git
cp .env.example .env
#change database config in .env
composer install
php artisan migrate --seed # create db and add test data
php artisan serve # start server in port 8000
```

