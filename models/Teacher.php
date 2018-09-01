<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 08.08.2018
 * Time: 15:10
 */

namespace app\models;
use yii\db\ActiveRecord;

class Teacher extends ActiveRecord
{
    public static function tableName()
    {
        return 'teachers';
    }

    public function getSubjects(){
        return $this->hasOne(Subject::className(), ['id' => 'teacher']);
    }

    public function getRooms(){
        return $this->hasOne(Room::className(), ['id' => 'teacher']);
    }



}