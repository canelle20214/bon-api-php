# bon-api-php

### Install local API

1. Install dependencies (with composer)
```shell
cd api
php composer.phar install
```

2. Edit your db info
* Copy and rename `api/dbConfig.example.php` in `api/dbConfig.php`
* Edit `web/dbConfig.php` with your DB info

3. Run the php server
```shell
php -S localhost:8000 -t api/public
```
