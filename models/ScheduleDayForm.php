<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 23.11.2018
 * Time: 22:54
 */

namespace app\models;


use yii\db\ActiveRecord;
use yii\base\Model;

class ScheduleDayForm extends ActiveRecord
{
    public static function tableName()
    {
        return 'schedule_day';
    }
    public  function rules()
    {
        return [
            ['day', 'required'],
            ['day', 'safe'],
            ['type', 'required'],
        ];

    }
}