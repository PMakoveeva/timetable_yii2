<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 01.09.2018
 * Time: 16:25
 */

namespace app\models;


use yii\db\ActiveRecord;

class ScheduleTypeForm extends ActiveRecord
{
    public static function tableName()
    {
        return 'schedule_types';
    }

    public function attributeLabels()
    {
        return [
            'type_name' => 'Название режима',
        ];
    }

    public function rules()
    {
        return [
            ['type_name', 'required']
        ];
    }

}