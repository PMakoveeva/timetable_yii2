<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 27.08.2018
 * Time: 22:14
 */

namespace app\models;


use yii\db\ActiveRecord;

class SubjectForm extends ActiveRecord
{

    public static function tableName()
    {
        return 'subjects';
    }

    public function attributeLabels(){
        return [
            'name' => 'Название предмета',
            'short_name' => 'Сокращение',
            'hardness' => 'Сложность',
            'teacher' => 'Учитель'
        ];
    }

    public function rules()
    {
        return  [
            [['name', 'short_name', 'hardness', 'teacher'], 'required'],
            [['name', 'short_name', 'teacher'],'string'],
            [['hardness'], 'integer', 'min'=>1, 'max'=>10],
        ];
    }

}