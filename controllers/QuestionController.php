<?php
namespace app\controllers;


use app\models\Question;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class QuestionController extends base\QuestionController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => [
                            'create', 'update', 'delete', 'new-question', 'create-question', 'upload-image'
                        ],
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'create-question' => ['POST'],
                ],
            ],
        ]);
    }

    public function actionNewQuestion()
    {
        return $this->render('new');
    }

    public function actionCreateQuestion()
    {
        $model = new Question();
        $model->content = \Yii::$app->request->getRawBody();
        $model->save();
    }

    public function actionUploadImage()
    {
        $filename = $_FILES['file']['name'];
        $destination = \Yii::getAlias('@webroot/upload/') . $filename;
        if(move_uploaded_file( $_FILES['file']['tmp_name'] , $destination )) {
            return \Yii::getAlias('@web/upload/') . $filename;
        } else
            return false;
    }
}