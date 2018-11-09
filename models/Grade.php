<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 22.08.2018
 * Time: 4:26
 */
namespace app\models;
use phpDocumentor\Reflection\Types\Self_;
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

    public static function getGradeId($name){
        $grade = Self::find()->where(['name' => $name])->asArray()->one();
        return $grade['id'];
    }

    public static function getGradeOrder($name){
        $grade = Self::find()->where(['name' => $name])->asArray()->one();
        return $grade['order'];
    }
    public static function getGradeName($id){
        $res = self::find()->where(['id' => $id])->one();
        return $res->name;
    }


}