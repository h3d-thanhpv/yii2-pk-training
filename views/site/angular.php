<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Angular demo');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-angular" ng-app="pkTrainApp" ng-controller="loadBookCtrl">
    <div class="form-group">
        <label for="exampleInputEmail1">Book Id</label>
        <input type="text" class="form-control" id="bookInputId" placeholder="Book id" ng-model="bookId">
    </div>
</div>

<?php $this->registerJsFile('@web/js/demo.js', ['depends' => [\app\assets\AngularAsset::className()]]) ?>
