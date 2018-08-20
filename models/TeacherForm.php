<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 08.08.2018
 * Time: 18:50
 */

namespace app\models;


use yii\base\Model;
use yii\db\ActiveRecord;

class TeacherForm extends ActiveRecord
{
    public static function tableName()
    {
        return 'teachers';
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
        ];
    }

    public function rules()
    {
        return [
            ['name', 'required' ],

        ];


    }

}