<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "{{%book}}".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property string $author
 * @property string $category
 * @property string $publishing_year
 * @property string $publishing_company
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%book}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['description'], 'string'],
            [['code'], 'string', 'max' => 30],
            [['name', 'author', 'category', 'publishing_company'], 'string', 'max' => 255],
            [['publishing_year'], 'string', 'max' => 10],
            [['code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'author' => Yii::t('app', 'Author'),
            'category' => Yii::t('app', 'Category'),
            'publishing_year' => Yii::t('app', 'Publishing Year'),
            'publishing_company' => Yii::t('app', 'Publishing Company'),
        ];
    }
}
