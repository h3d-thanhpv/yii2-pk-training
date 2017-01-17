<?php
/**
 * Created by PhpStorm.
 * User: thanh
 * Date: 8/1/2017
 * Time: 4:53 PM
 */

namespace api\modules\v1\controllers\token;

use api\components\JwtHelper;
use yii\base\Exception;
use yii\rest\Action;

class GenerateAction extends Action
{
    /** @var int $tokenType */
    public $tokenType;

    /** @var JwtHelper $jwtHelper */
    protected $jwtHelper;

    public function init()
    {
        if($this->tokenType == JwtHelper::HMAC_SIGN || $this->tokenType == JwtHelper::RSA_SIGN)
            $this->jwtHelper = JwtHelper::getInstance($this->tokenType);
        else
            throw new Exception('Algorithm not supported');
    }

    public function run()
    {
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id);
        }
        return [
            'token' => $this->jwtHelper->generateToken()
        ];
    }
}