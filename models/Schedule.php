<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 14.09.2018
 * Time: 21:02
 */

namespace app\models;


use phpDocumentor\Reflection\Types\Self_;
use yii\db\ActiveRecord;
use app\models\Subject;
use Yii;
use yii\db\Command;

class Schedule extends ActiveRecord
{
    public static function tableName()
    {
        return 'schedules';
    }

    public static function getTeacher(){

    }
    public function getSubject(){
        return $this->hasOne(Subject::className(), ['id' => 'subject']);
    }

    public static function getFirstOrderForGrade($grade, $day){
        $firstLessons = self::find()->where(['grade' => $grade, 'day' => $day])->orderBy(['order' => SORT_ASC])->one();
        return $firstLessons;
    }
    public static function getLessonsForGrade($grade, $day){
        $lessons = array();
        $lessonsDB=self::find()->select(['grade', 'day', 'order', 'subject'])->where(['grade' => $grade, 'day' => $day])->orderBy(['order' => SORT_ASC])->asArray()->distinct()->all();
        for ($i=0; $i<count($lessonsDB); $i++){
            $lessons[$i]=$lessonsDB[$i]['subject'];
        }
        return $lessons;
    }
    public static function copyDay($copyId, $dayId)
    {
        if ($copyId != null) {
            $post = Yii::$app->db->createCommand("insert into schedules select null, $dayId, `subject`, `order`, `grade`, `room` from schedules where `day`=". $copyId)
                ->execute();

        }
    }

    public static function getLessons_id($day){
        $data=Schedule::getSchedule($day);
        $lessons=[];
        foreach ($data as $item){
            $lessons[$item['order']][$item['grade']] = ($item['id']);
        }
        return $lessons;
    }

    public static function getSchedule($day){
        $res=self::find()->where(['day' => $day])->orderBy(['order' => SORT_ASC])->asArray()->all();
//        $res=selectData('schedules', '', ['day'=>$day], ['order'=>SORT_ASC]);
        return $res;
    }
    public static function getLessons($day){
        $data=Schedule::getSchedule($day);
        $lessons=[];
        foreach ($data as $item){
            $lessons[$item['order']][$item['grade']] = Subject::getShortName($item['subject']);
        }
    return $lessons;
    }
    public static function getRoom($id){
        $res = Schedule::find()->where(['id' => $id])->one();
        if(isset($res)) {
            return $res->room;
        }
        return ' ';
    }
    public static function getSubjectTeacher($teach_id, $day){
        /*var_dump($teach_id);
        var_dump($day);*/
        $day = ScheduleDay::getIdDay($day);
        $teach_id = (int)$teach_id;
        $subjects = self::find()->innerJoin('subjects', 'schedules.subject = subjects.id')->andWhere(['subjects.teacher' => $teach_id, 'schedules.day' => $day])->orderBy('schedules.order', SORT_DESC)->asArray()->all();
        return $subjects;
    }
    public static function hasRepeat($grade, $subject, $order, $day){
        $teacher=Teacher::getTeacher(Subject::getTeacher($subject));
        $sub=Subject::find()->select('id')->where(['teacher' => $teacher['id']]);
        $ret = self::find()->where(['IN', 'subject', $sub])->andWhere(['order' => $order, 'day' => $day])->one();
        /*$roomsql = $ret->createCommand()->getRawSql();
        var_dump($roomsql);
        exit();*/
        if(empty($ret)){
            return null;
        }
        else{
            return $ret;
        }


    }
    public static function getSubjectGrade($grade_id, $day){
        $day = ScheduleDay::getIdDay($day);
        $grade_id = (int)$grade_id;
        $subjects = self::find()->innerJoin('subjects', 'schedules.subject=subjects.id')->andWhere(['schedules.grade' => $grade_id, 'schedules.day' => $day])->orderBy('schedules.order', SORT_DESC)->asArray()->all();
        return $subjects;
    }
}