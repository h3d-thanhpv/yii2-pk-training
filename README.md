ProjectKit Training - Yii2 Basic Template
============================


Tag 0.1: Init app
--------------
Init basic app from [https://github.com/yiisoft/yii2-app-basic](https://github.com/yiisoft/yii2-app-basic)

```
composer global require "fxp/composer-asset-plugin:*"
composer create-project --prefer-dist yiisoft/yii2-app-basic yii2-training
```

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

Tag 0.4: Pretty url and add custom routing
--------------

Enable pretty url in `urlManager` component config.

```php
'urlManager' => [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
    ],
],
```

Add htaccess config for rewrite url in `web` folder.

```
RewriteEngine on
RewriteBase /yii2-training/web
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d 

RewriteRule . index.php
```

Use parameterizing route config
 
```
'urlManager' => [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        '<controller>/<action:(view)>/<id:\d+>' => '<controller>/<action>',
        '<controller>s' => '<controller>/index',
    ],
],
```

Now you can show list book in link: [http://localhost/yii2-training/web/books](http://localhost/yii2-training/web/books)

And view detail a book: [http://localhost/yii2-training/web/book/view/1](http://localhost/yii2-training/web/book/view/1)

Tag 0.5: Use access control
-----------------

We will implement that: `User must login to view list book, create, delete book`

Update `behaviors` function in `BookController`

```php
public function behaviors()
{
    return array_merge(parent::behaviors(), [
        'access' => [
            'class' => AccessControl::className(),
            'rules' => [
                // allow authenticated users
                [
                    'allow' => true,
                    'roles' => ['@'],
                ],
                // everything else is denied
            ],
        ],
    ]);
}
```

Tag 0.6: Implement API modules
----------------

Create folder `api` and implement API module in this folder.

You can list all book via rest api: [http://localhost/yii2-training/api/v1/books](http://localhost/yii2-training/api/v1/books)

