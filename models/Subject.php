<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 08.08.2018
 * Time: 15:26
 */

namespace app\models;
use yii\db\ActiveRecord;

class Subject extends ActiveRecord
{

    public static function tableName()
    {
        return 'subjects';
    }

    public function getTeacher(){
        return $this->hasOne(Teacher::className(), ['id' => 'teacher']);
    }

}