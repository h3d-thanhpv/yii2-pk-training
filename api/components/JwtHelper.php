<?php
/**
 * Created by PhpStorm.
 * User: thanh
 * Date: 13/1/2017
 * Time: 9:57 AM
 */

namespace api\components;

use Firebase\JWT\JWK;
use Firebase\JWT\JWT;
use phpseclib\Crypt\RSA;
use Yii;
use yii\base\Exception;
use yii\helpers\Json;
use yii\web\ServerErrorHttpException;
use yii\web\UnauthorizedHttpException;

class JwtHelper
{
    /**
     * @var string $issuer
     */
    protected $issuer;

    /**
     * @var string $audience
     */
    protected  $audience;

    /** @var int $duration */
    protected  $duration = 86400;

    /**
     * @var int $issuer
     */
    protected $leeway = 10;

    /** @var self $instance  */
    private static $instance = null;

    /** @var int $tokenType */
    private $tokenType;

    const HMAC_SIGN = 1;

    const RSA_SIGN = 2;

    /** @var string $rsaPrivatePath */
    public $rsaPrivatePath;

    public function __construct()
    {
        $this->issuer = Yii::$app->params['iss'];
        $this->audience = Yii::$app->params['aud'];
        $this->rsaPrivatePath = \Yii::getAlias('@api'). "/certs/privkey.pem";
    }

    /**
     * @param int $type
     * @return JwtHelper
     */
    public static function getInstance($type = self::HMAC_SIGN)
    {
        if(!self::$instance) {
            self::$instance = new JwtHelper();
        }

        if($type == self::HMAC_SIGN ||  $type == self::RSA_SIGN) {
            self::$instance->tokenType = $type;
        }
        return self::$instance;
    }

    public function generateToken()
    {
        $curTime = time();
        $tokenId = Yii::$app->security->generateRandomString(32);
        $tokenInfo = [
            'iss' => $this->issuer,
            'aud' => $this->audience,
            'iat' => $curTime,
            'exp' => $curTime + $this->duration,
            'jti' => $tokenId,
        ];

        if($this->tokenType == self::HMAC_SIGN) {
            $privateKey = Yii::$app->params['privateKey'];
            $algorithm = "HS256";
        } elseif ($this->tokenType == self::RSA_SIGN) {
            $privateKey = $this->getPrivateKey();
            $algorithm = "RS256";
        } else {
            throw new Exception('Algorithm not supported');
        }

        $jwt = JWT::encode($tokenInfo, $privateKey, $algorithm);
        $this->setState($tokenId, $jwt, $this->duration);
        return $jwt;
    }

    private function setState($key, $data, $duration)
    {
        $cache = Yii::$app->getCache();
        if($cache) {
            $cache->set($key, $data, $duration);
        } else {
            throw new ServerErrorHttpException("Please enable cache component");
        }
    }

    private function getState($key)
    {
        $cache = Yii::$app->getCache();
        if($cache) {
            return $cache->get($key);
        } else {
            throw new ServerErrorHttpException("Please enable cache component");
        }
    }

    public function verify($token) {
        try {
            if($this->tokenType == self::HMAC_SIGN) {
                $privateKey = Yii::$app->params['privateKey'];
                $algorithm = "HS256";
            } elseif ($this->tokenType == self::RSA_SIGN) {
                $pubKey = Json::decode($this->getPublicKey()->toString());
                $privateKey = JWK::parseKey($pubKey);
                $algorithm = "RS256";
            } else {
                throw new Exception('Algorithm not supported');
            }
            $tokenInfo = JWT::decode($token, $privateKey, [$algorithm]);
            return ($tokenInfo && property_exists($tokenInfo, 'jti') && $this->getState($tokenInfo->jti));
        } catch (Exception $e) {
            throw new UnauthorizedHttpException($e->getMessage());
        }
    }

    /**
     * @return bool|resource
     * @throws Exception
     */
    public function getPrivateKey()
    {
        $privKey = openssl_pkey_get_private("file://" . $this->rsaPrivatePath);
        if($privKey) {
            return $privKey;
        } else {
            throw new Exception("Can't get private key from path " . $this->rsaPrivatePath);
        }
    }

    /**
     * @return \JOSE_JWK
     */
    public function getPublicKey()
    {
        $privKey = $this->getPrivateKey();
        $keyData = openssl_pkey_get_details($privKey);
        $publicPem = $keyData['key'];
        $publicKey = new RSA();
        $publicKey->loadKey($publicPem);
        return \JOSE_JWK::encode($publicKey);
    }
}