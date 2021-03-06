<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 01.09.2018
 * Time: 4:26
 */

namespace app\models;

use yii\db\ActiveRecord;


class RoomForm extends ActiveRecord
{
    public static function tableName()
    {
        return 'rooms'; // TODO: Change the autogenerated stub
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Номер кабинета',
            'teacher' => 'Учитель'
        ];
    }

    public  function rules()
    {
        return [
            ['name', 'required'],
            [['name'], 'integer', 'max' => \Yii::$app->params['maxNumRoom'] , 'min' => \Yii::$app->params['minNumRoom']],
            [['teacher'], 'integer'],
        ];

    }

}