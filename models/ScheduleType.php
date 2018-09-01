<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 01.09.2018
 * Time: 16:07
 */

namespace app\models;


use yii\db\ActiveRecord;

class ScheduleType extends ActiveRecord
{
    public static function tableName()
    {
        return 'schedule_types';
    }

}