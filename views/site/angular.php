<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\JsAsset;


/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Angular demo');
$this->params['breadcrumbs'][] = $this->title;

JsAsset::register($this);
?>

<div class="site-angular" ng-app="pkTrainApp" ng-controller="loadBookCtrl">
    <div class="form-group">
        <label for="exampleInputEmail1">Book Id</label>
        <input type="text" class="form-control" id="bookInputId" placeholder="Book id" ng-model="bookId">
    </div>

    <p>ID: <span ng-bind="bookInfo.id"></span></p>
    <p>code: <span ng-bind="bookInfo.code"></span></p>
    <p>name: <span ng-bind="bookInfo.name"></span></p>
    <p>description: <span ng-bind="bookInfo.description"></span></p>
    <p>author: <span ng-bind="bookInfo.author"></span></p>
    <p>category: <span ng-bind="bookInfo.category"></span></p>
    <p>publishing_year: <span ng-bind="bookInfo.publishing_year"></span></p>
    <p>publishing_company: <span ng-bind="bookInfo.publishing_company"></span></p>
</div>
