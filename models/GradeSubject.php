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

    public function getSubject(){
        return $this->hasMany(Subject::className(), ['id' => 'subject']);
    }



}