<?php
namespace app\assets;

use yii\web\AssetBundle;

class AngularAsset extends AssetBundle
{
    public $sourcePath = '@webroot/angular';
    public $js = [
        'angular.min.js',
        'ui-bootstrap-tpls-2.1.3.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}