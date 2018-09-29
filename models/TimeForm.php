<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 07.09.2018
 * Time: 0:53
 */

namespace app\models;


use yii\db\ActiveRecord;

class TimeForm extends ActiveRecord
{
    public static function tableName()
    {
        return 'schedule_times';
    }

    public function attributeLabels()
    {
        return [
            'time_start' => 'время начала урока',
            'lesson_long' => 'длительность урока',
            'break_long' => 'длительность перемены',
        ];
    }

    public function rules()
    {
        return [
            [['lesson_long', 'time_start', 'break_long'], 'required'],
            [['lesson_long', 'break_long'], 'integer'] //TODO сделать фильтр для time_start
        ];
    }

}