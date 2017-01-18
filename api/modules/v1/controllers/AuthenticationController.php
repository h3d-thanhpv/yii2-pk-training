<?php

namespace api\modules\v1\controllers;

use api\modules\v1\models\IpRateLimiter;
use fproject\rest\ActiveController;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\filters\RateLimiter;
use yii\web\Response;

class AuthenticationController extends ActiveController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;

        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                HttpBearerAuth::className(),
                QueryParamAuth::className(),
            ],
        ];

        $behaviors['rateLimiter'] = [
            'class' => RateLimiter::className(),
            'user' => IpRateLimiter::getInstance(),
        ];

        return $behaviors;
    }
}