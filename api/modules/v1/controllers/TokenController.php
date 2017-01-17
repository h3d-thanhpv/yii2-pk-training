<?php
/**
 * Created by PhpStorm.
 * User: thanh
 * Date: 13/1/2017
 * Time: 9:54 AM
 */

namespace api\modules\v1\controllers;

use api\components\JwtHelper;
use api\modules\v1\controllers\token\GenerateAction;
use api\modules\v1\controllers\token\PublicKeyAction;
use yii\rest\Controller;

class TokenController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'generate-private' => [
                'class' => GenerateAction::className(),
                'modelClass' => null,
                'tokenType' => JwtHelper::HMAC_SIGN,
            ],
            'generate-public' => [
                'class' => GenerateAction::className(),
                'modelClass' => null,
                'tokenType' => JwtHelper::RSA_SIGN,
            ],
            'public-key' => [
                'class' => PublicKeyAction::className(),
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
            'generate-private' => ['POST'],
            'generate-public' => ['POST'],
            'public-key' => ['GET']
        ];
    }
}