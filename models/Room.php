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
        return $res->name;
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