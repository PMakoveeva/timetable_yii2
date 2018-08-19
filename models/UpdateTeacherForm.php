<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 20.08.2018
 * Time: 3:19
 */

namespace app\models;




use yii\db\ActiveRecord;

class UpdateTeacherForm extends ActiveRecord
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