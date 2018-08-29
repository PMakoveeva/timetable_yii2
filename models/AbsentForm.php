<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 30.08.2018
 * Time: 2:25
 */

namespace app\models;

namespace app\models;


use yii\base\Model;
use yii\db\ActiveRecord;


class AbsentForm extends ActiveRecord
{
    public static function tableName()
    {
        return 'teachers';
    }

    public function attributeLabels()
    {
        return [
            'from' => 'Отсутствие начиная с',
            'to' => 'До',
            'reason' => 'Причина отсутствия'
        ];
    }

    public function rules()
    {
        return [
            [['from','to', 'reason'], 'required'],
            [['reason'], 'integer', 'min'=>1, 'max'=>3]
        ];


    }
}