<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 01.09.2018
 * Time: 4:05
 */

namespace app\models;
use yii\db\ActiveRecord;

class Room extends ActiveRecord
{
    public static function tableName()
    {
        return 'rooms';
    }

    public function getTeacher(){
        return $this->hasOne(Teacher::className(), ['teacher' => 'id']);
    }

}