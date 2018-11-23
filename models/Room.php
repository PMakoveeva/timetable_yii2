<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 01.09.2018
 * Time: 4:05
 */

namespace app\models;
use yii\db\ActiveRecord;

class Room extends ActiveRecord
{
    public static function GetEmptyRoom($day, $order){
        $busy = [];
        $ret = Schedule::find()->select('room')->where(['day' => $day, 'order' => $order]);

       /* for($i=0; $i<count($ret); $i++){
            if($ret[$i]['room']!=null){
                $busy[$i]=$ret[$i]['room'];
            }
        }*/
        $room = Room::find()->select('name')->orderBy(['name'=>SORT_ASC])->where(['NOT IN', 'id', $ret])->indexBy('id')->column();
        /*$roomsql = $room->createCommand()->getRawSql();
        var_dump($roomsql);
        exit();*/
        return $room;
    }
    public static function tableName()
    {
        return 'rooms';
    }

    public function getTeacher(){
        return $this->hasOne(Teacher::className(), ['teacher' => 'id']);
    }
    public static function getRooms(){ //TODO: сделать автоматическую постановку кабинета
        $res = self::find()->asArray()->all();
        return $res;
    }
    public static function getNameRoom($idRoom){
        $res = self::find()->where(['id' => $idRoom])->one();
        if(isset($res->name)){
            return $res->name;
        }
        return '';
    }
    public static function getRoomForSchedule($room, $teacher){
        if(!empty($room)){
            return $room;
        }
        else{
            $room = Room::getRoomTeacher($teacher);
            if(!empty($room)){
                return $room;
            }
            else{
                return '';//TODO: сделать добавление из списка свободных
            }
        }
    }
    public static function getRoomTeacher($teacher){
        $res = self::find()->where(['teacher' => $teacher])->one();
        if(isset($res->name)) {
            return $res->name;
        }
        return '';
    }



}