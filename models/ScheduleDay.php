<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 13.09.2018
 * Time: 1:29
 */

namespace app\models;


use yii\db\ActiveRecord;

class ScheduleDay extends ActiveRecord
{
    public static function tableName()
    {
        return 'schedule_day';
    }
    public static function getLastDay(){
        $day = self::find()->orderBy(['day' => SORT_DESC])->one();
        return $day;
    }
    public static function getDay($id) {
        $res=self::find()->where(['id' => $id])->one();
        if(isset($res->day)) {
            return $res->day;
        }
        return '';
    }
    public static function getIdDay($day){
        $res = self::find()->where(['day' => $day])->one();
        return $res;
    }
    public static function getSchedule_dayInTable($id){
        $id = (int)$id;
        $res = self::find()->where(['id' => $id])->asArray()->one();
        return $res;
    }
    public static function getNameDayOfWeek($number){
        switch ($number){
            case 1:
                return 'Понедельник';
            case 2:
                return 'Вторник';
            case 3:
                return 'Среду';
            case 4:
                return 'Четверг';
            case 5:
                return 'Пятницу';
            case 6:
                return 'Субботу';
        }
    }
    public static function getShortNameDayOfWeek($number){
        switch ($number){
            case 1:
                return 'Пн';
            case 2:
                return 'Вт';
            case 3:
                return 'Ср';
            case 4:
                return 'Чт';
            case 5:
                return 'Пт';
            case 6:
                return 'Сб';
            case 0:
                return 'Вс';
        }
    }
    public static function getTypeDay($day){
        $res = self::find()->where(['id' => $day])->one();
        if(isset($res->type)) {
            return $res->type;
        }
        return '';
    }

    public static function getDayslimit6(){
        $res = self::find()->orderBy(['day' => SORT_DESC])->limit(6)->asArray()->all();
        return $res;
    }
}