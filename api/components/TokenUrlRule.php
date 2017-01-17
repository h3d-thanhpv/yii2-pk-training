<?php
/**
 * Created by PhpStorm.
 * User: thanh
 * Date: 13/1/2017
 * Time: 10:43 AM
 */

namespace api\components;

use fproject\rest\UrlRule;

class TokenUrlRule extends UrlRule
{
    /** @inheritdoc */
    public $patterns = [
        'POST generate-private' => 'generate-private',
        'POST generate-public' => 'generate-public',
        'GET public-key' => 'public-key'
    ];
}