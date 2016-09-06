<?php

namespace app\assets;


use yii\web\AssetBundle;

class QuestionAsset extends AssetBundle
{
    public $sourcePath = '@webroot/js';
    public $js = [
        'question.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'app\assets\AngularAsset',
    ];
}