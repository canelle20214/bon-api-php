# <center>BON' API</center>

---
---

### Install local API (PHP 8.1)

#### 1. Install dependencies (with composer)
```shell
cd api
php composer.phar install
```

#### 2. Create / Import dump
```sql
CREATE DATABASE bon_api_php CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```
Then you have to import dump located here:
`dump/bon-api.sql`

#### 3. Edit your db info
* Copy and rename `api/dbConfig.example.php` in `api/dbConfig.php`
* Edit `api/dbConfig.php` with your DB info

#### 4. Run the php server
```shell
php -S localhost:8000 -t api/public
```

----
----

### Install local front (Next.JS)

#### 1. Install packages
```shell
cd front
npm install
```

#### 2. Run front
```shell
npm run dev
```
