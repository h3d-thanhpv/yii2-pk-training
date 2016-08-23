ProjectKit Training - Yii2 Basic Template
============================


Tag 0.1: Init app
--------------
Init basic app from [https://github.com/yiisoft/yii2-app-basic](https://github.com/yiisoft/yii2-app-basic)

Tag 0.2: Config DB and migration
--------------
Modify db config base on your mysql server:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=pk-yii2',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',
];
```

Run command on your command-line:
 
 ```
 yii migrate/create add_book_table
 ```
 
After that, yii2 will create a migration script on `migrations` folder. Example name: `m160823_032016_add_book_table.php`

Modify migration script for create table, insert test data, ... to database

Run `yii migrate` to apply your migration.

Tag 0.3: CRUD with gii generator
--------------

Example gii generator link: [http://localhost/yii2-training/web/index.php?r=gii](http://localhost/yii2-training/web/index.php?r=gii)

Generate model and CRUD for book table.


