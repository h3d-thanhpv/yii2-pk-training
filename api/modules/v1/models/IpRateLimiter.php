<?php
/**
 * Created by PhpStorm.
 * User: thanh
 * Date: 18/1/2017
 * Time: 3:05 PM
 */

namespace api\modules\v1\models;

use yii\base\Object;
use yii\filters\RateLimitInterface;
use yii\web\TooManyRequestsHttpException;

class IpRateLimiter extends Object implements RateLimitInterface
{
    public $rateLimit = 10;

    public $allowanceKey = 'allowance_key_';

    public $allowanceUpdatedAtKey = 'allowance_updated_at_key_';

    /** @var self $instance  */
    private static $instance = null;

    public static function getInstance()
    {
        if(!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @param \yii\web\Request $request
     * @param \yii\base\Action $action
     * @return array
     */
    public function getRateLimit($request, $action)
    {
        return [$this->rateLimit, 1]; // $rateLimit requests per second
    }

    /**
     * @param \yii\web\Request $request
     * @param \yii\base\Action $action
     * @return array
     * @throws TooManyRequestsHttpException
     */
    public function loadAllowance($request, $action)
    {
        $cache = \Yii::$app->getCache();
        if ($cache) {
            $userIP = $request->getUserIP();
            $allowance = $cache->get($this->allowanceKey . $userIP);
            $allowanceUpdatedAt = $cache->get($this->allowanceUpdatedAtKey . $userIP);
            return [$allowance, $allowanceUpdatedAt];
        } else {
            throw new TooManyRequestsHttpException("Please enable cache component");
        }
    }

    /**
     * @param \yii\web\Request $request
     * @param \yii\base\Action $action
     * @param int $allowance
     * @param int $timestamp
     * @throws TooManyRequestsHttpException
     */
    public function saveAllowance($request, $action, $allowance, $timestamp)
    {
        $cache = \Yii::$app->getCache();
        if ($cache) {
            $userIP = $request->getUserIP();
            $cache->set($this->allowanceKey . $userIP, $allowance);
            $cache->set($this->allowanceUpdatedAtKey . $userIP, $timestamp);
        } else {
            throw new TooManyRequestsHttpException("Please enable cache component");
        }
    }
}