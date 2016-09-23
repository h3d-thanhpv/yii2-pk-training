<?php

namespace api\modules\v1\controllers\translate;

use Stichoza\GoogleTranslate\TranslateClient;
use yii\rest\Action;
use yii\web\BadRequestHttpException;

class CreateAction extends Action
{

    /**
     * @inheritdoc
     * */
    public function init()
    {
        //Do nothing
    }

    /**
     * Translate action
     *
     */
    public function run()
    {
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id);
        }
        $data = \Yii::$app->getRequest()->getBodyParams();
        if(!array_key_exists('source', $data) || !array_key_exists('target', $data) || !array_key_exists('text', $data)) {
            throw new BadRequestHttpException('Data must include source, target and text');
        }
        /** @noinspection PhpMethodParametersCountMismatchInspection */
        return [
            'source' => $data['source'],
            'target' => $data['target'],
            'text' => $data['text'],
            'result' => TranslateClient::translate($data['source'], $data['target'], $data['text']),
        ];
    }
}