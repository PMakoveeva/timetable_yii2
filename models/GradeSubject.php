<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 22.08.2018
 * Time: 5:10
 */

namespace app\models;
use yii\db\ActiveRecord;

class GradeSubject extends ActiveRecord
{

    public static function tableName()
    {
        return 'grade_subject';
    }

    public function getSubject0(){
        return $this->hasMany(Subject::className(), ['id' => 'subject']);
    }
    public static function getSubjectsListGrade($grade){
        $subjects = GradeSubject::find()->where(['grade' => $grade])->with('subject0')->all();
        $ret = [];
        foreach ($subjects as $subject) {
                //var_dump($subject->subject);
                $ret[$subject->subject] = Subject::getFullName($subject->subject) . ' / ' . Subject::getTeacherName($subject->subject);
        }
        return $ret;
    }



}