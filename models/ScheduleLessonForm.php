<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 21.11.2018
 * Time: 11:59
 */
namespace app\models;


use yii\db\ActiveRecord;

class ScheduleLessonForm extends ActiveRecord
{
    public static function tableName()
    {
        return 'schedules';
    }
    public function attributeLabels()
    {
        return [
            'subject' => 'Название предмета / учитель',
            'room' => 'Номер кабинета',
        ];
    }
    public function rules()
    {
        return [
            [['subject', 'day', 'order', 'grade', 'room'], 'required']
        ];
    }

}

