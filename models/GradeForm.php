<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 22.08.2018
 * Time: 4:31
 */
namespace app\models;


use yii\base\Model;
use yii\db\ActiveRecord;

class GradeForm extends ActiveRecord
{
    public static function tableName()
    {
        return 'grades';
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название класса',
            'order' => 'Порядковый номер в расписании',
        ];
    }

    public function rules()
    {
        return [
            ['name', 'required'],
            ['order', 'required'],

        ];


    }
}

