<?php

namespace app\models;

use Yii;
use app\components\MyBehavior;

/**
 * This is the model class for table "country".
 *
 * @property string $code
 * @property string $name
 * @property int $population
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['population'], 'integer'],
            [['code'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 52],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code' => 'Code',
            'name' => 'Name',
            'population' => 'Population',
        ];
    }
    
    public function behaviors(){
        return [
            'myBehavior1' => [
                'class' => MyBehavior::className(),
                'prop1' => 'value1',
                'prop2' => 'value2',
            ],
            'myBehavior2' => [
                'class' => MyBehavior::className(),
                'prop1' => 'value11',
                'prop2' => 'value22',
            ]
        ];
    }
}
