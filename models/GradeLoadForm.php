<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 31.08.2018
 * Time: 1:57
 */

namespace app\models;

use yii\db\ActiveRecord;


class GradeLoadForm extends ActiveRecord
{
    public static function tableName(){
        return 'grade_subject';
    }

    public function attributeLabels()
    {
        return [
            'grade' => 'Класс',
            'subject' => 'Название предмета',
            'hour' => 'Количество часов в неделю',
        ];
    }

    public function rules()
    {
        return [
            [['subject', 'grade', 'hour'], 'required'],
            [['hour'], 'integer', 'min'=>1, 'max'=>16],
        ];
    }

}