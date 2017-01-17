<?php
/**
 * Created by PhpStorm.
 * User: thanh
 * Date: 13/1/2017
 * Time: 2:33 PM
 */

namespace api\modules\v1\controllers\token;


use api\components\JwtHelper;
use yii\base\Exception;
use yii\helpers\Json;
use yii\rest\Action;

class PublicKeyAction extends Action
{
    /** @var string $rsaPublicPem */
    protected $rsaPublicPem;

    protected $pubKeyCached;

    protected $cacheKey = "public_key_generated";

    /**
     * Time in second -> 1 week
     * @var int $cacheDuration
     */
    protected $cacheDuration = 604800;

    public function init()
    {
        $cache = \Yii::$app->getCache();
        if($cache) {
            $this->pubKeyCached = $cache->get($this->cacheKey);
        } else {
            throw new Exception('Cache component required!');
        }
    }

    public function run()
    {
        $jwk = $this->pubKeyCached;
        if(!$jwk) {
            $jwtHelper = JwtHelper::getInstance(JwtHelper::RSA_SIGN);
            $jwk = $jwtHelper->getPublicKey()->toString();
            \Yii::$app->getCache()->set($this->cacheKey, $jwk, $this->cacheDuration);
        }
        return [
            'keys' => [
                Json::decode($jwk)
            ],
        ];
    }
}