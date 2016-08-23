<?php

namespace app\assets;


use yii\web\AssetBundle;

class JsAsset extends AssetBundle
{
    public $sourcePath = '@webroot/js';
    public $js = [
        'demo.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'app\assets\AngularAsset',
    ];
}