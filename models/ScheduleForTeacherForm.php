<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 06.10.2018
 * Time: 21:18
 */

namespace app\models;


use yii\base\Model;

class ScheduleForTeacherForm extends Model
{
    public function attributeLabels()
    {
        return [
            'answer' => 'Ответ',
        ];
    }
    public function rules()
    {
        return [
            ['answer', 'required', 'message' => 'Нет ответа, хи-хи'],
            ['answer', 'integer'],
        ];
    }

}