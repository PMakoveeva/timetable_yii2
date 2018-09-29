<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 01.09.2018
 * Time: 17:59
 */

namespace app\models;


use yii\db\ActiveRecord;

class ScheduleTime extends ActiveRecord
{
    public static function tableName()
    {
        return 'schedule_times';
    }

    public static function IntToTime($timeMinutes, $array = false){
        $minutes=(int)($timeMinutes%60);
        $hours=(int)($timeMinutes/60);
        if($minutes<10){
            $minutes='0'.$minutes;
        }if($hours<10){
            $hours='0'.$hours;
        }
        if ($array) {

            $time['h']=$hours;

            $time['m']=$minutes;
            return $time;
        }
        else{
            $string=$hours.":".$minutes;
            return $string;
        }
    }

    public static function TimeToInt($string){
            $str1=stristr($string, ':', true);
            $str2=stristr($string, ':');
            $str2=mb_substr($str2, 1);
            $str1=(int)$str1;
            $str2=(int)$str2;
            //var_dump($str2); exit();
            $res=$str1*60+$str2;
            //var_dump($res); exit();
            return $res;
    }
    public static function getTime_start($dayId){
        $day = ScheduleDay::find()->where(['id'=>$dayId])->one();//
        $times = self::find()->where(['schedule_type' => $day->type])->orderBy(['time_start' => SORT_ASC])->asArray()->all();
        return $times;
    }

}