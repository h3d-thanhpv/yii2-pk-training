<?php

namespace app\assets;


use yii\bootstrap\BootstrapPluginAsset;
use yii\web\AssetBundle;

class QuestionAsset extends AssetBundle
{
    public $sourcePath = '@webroot/js';
    public $js = [
        'ng-file-upload-all.min.js',
        'question.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'app\assets\AngularAsset',
    ];
}