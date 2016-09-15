<?php
namespace app\models;

/**
 * @property integer $totalQuestion
 */
class Question extends base\Question
{
    public function getTotalQuestion()
    {
        return self::find()->count();
    }

}