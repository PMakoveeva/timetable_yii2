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
    public  static  function  getGrades(){
        $grade = Self::find()->orderBy(['order' => SORT_ASC])->asArray()->one();
        return $grade['id'];
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
    public static function getGradesList(){
        $grades = self::find()->orderBy('order')->all();
        $ret = [];
        foreach ($grades as $grade) {
            if($grade->name != null) {
                $ret[$grade->id] = $grade->name;
            }
        }
        return $ret;


    }



}