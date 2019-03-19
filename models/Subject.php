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
    public function getTeacher0(){
        return $this->hasOne(Teacher::className(), ['id' => 'teacher']);
    }
    public static function getSubjectsList(){
        $subjects = self::find()->with('teacher0')->all();
        $ret = [];
        foreach ($subjects as $subject) {
            if($subject->teacher != null) {
                //var_dump($subject->teacher0->name);

                $ret[$subject->id] = $subject->name . ' / ' . $subject->teacher0->name;
            }
        }
        return $ret;
    }


    public static function getShortName($subjectId){
        $subject = self::find()->where(['id' => $subjectId])->one();
        return $subject->short_name;
    }
    public static function getTeacher($sub_id){
        $res = self::find()->where(['id' => $sub_id])->asArray()->one();
        return $res['teacher'];
    }
    public static function getTeacherName($sub_id){
        $res = self::find()->where(['id' => $sub_id])->asArray()->one();
        $ret = Teacher::getTeacher($res['teacher']);
        return $ret['name'];
    }
    public static function getIdSub_ShortName($short_name){
        $res = self::find()->where(['short_name' => $short_name])->one();
        if(isset($res->id)) {
            return $res->id;
        }
        return '';
    }
    public static function getShortName_Id($id){
        $res = self::find()->where(['id' => $id])->one();
        if(isset($res->short_name)){
            return $res->short_name;
        }
        return '';
    }
    public static function getFullName($id){
        $res = self::find()->where(['id' => $id])->one();
        if(isset($res->name)){
            return $res->name;
        }
        return '';
    }

}