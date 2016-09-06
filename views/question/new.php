<?php
use app\assets\QuestionAsset;

/* @var $this yii\web\View */

$this->title = Yii::t('app/pk', 'Create question with angular');
$this->params['breadcrumbs'][] = $this->title;

QuestionAsset::register($this);

?>
<div class="site-angular" ng-app="questionApp" ng-controller="newController">
    <div class="form-group">
        <label for="questionInput">Câu hỏi</label>
        <input type="text" class="form-control" id="questionInput" placeholder="Câu hỏi" ng-model="questionInfo.question">
    </div>
    <div class="answer">
        <label for="answerInput">Đáp án</label>
        <button type="button" class="btn btn-primary" id="addAnswerButton" ng-click="addAnswer()">Thêm đáp án</button>
        <div ng-repeat="answer in questionInfo.answers">
            <div class="answer-group row">
                <input class="col-xs-1" type="checkbox" title="Đáp án đúng" ng-model="answer.isTrue"/>
                <input class="col-xs-5" type="text" placeholder="Đáp án" ng-model="answer.content">
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-primary" id="addAnswerButton" ng-click="createQuestion()">Tạo câu hỏi</button>
    <pre>{{questionInfo | json}}</pre>
</div>

<style>
    .answer-group {
        padding: 5px 0;
    }
</style>

