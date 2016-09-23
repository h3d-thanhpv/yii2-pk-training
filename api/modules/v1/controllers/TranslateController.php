<?php

namespace api\modules\v1\controllers;


use yii\rest\Controller;

class TranslateController extends Controller
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'create' => [
                'class' => 'api\modules\v1\controllers\translate\CreateAction',
                'modelClass' => null,
            ],
        ];

    }

    /**
     * @inheritdoc
     */
    protected function verbs()
    {
        return [
            'create' => ['POST'],
        ];
    }
}