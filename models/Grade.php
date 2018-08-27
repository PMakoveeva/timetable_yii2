<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 22.08.2018
 * Time: 4:26
 */
namespace app\models;
use yii\db\ActiveRecord;

class Grade extends ActiveRecord
{
    public static function tableName()
    {
        return 'grades';
    }
    public function getSubject(){
        return $this->hasOne(Subject::className(), ['subject' => 'id']);
    }


}