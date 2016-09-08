<?php

namespace app\controllers;

use app\models\Book;
use yii\filters\AccessControl;

class BookController extends base\BookController
{
    /**
     * @inheritdoc
     */
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

    public function actionViewAllBook()
    {
        $id = 1;
        /** @var Book[] $books */
        $books = Book::find()->select(['code', 'name', 'author as tacgia'])->where(['id' => $id])->all();
        echo $books[0]->totalBook;
        var_dump($books);
    }
}
