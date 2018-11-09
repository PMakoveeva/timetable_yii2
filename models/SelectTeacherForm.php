<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 10.11.2018
 * Time: 0:10
 */

namespace app\models;

use yii\db\ActiveRecord;


class SelectTeacherForm extends ActiveRecord
{
    public $name;
    public function attributeLabels()
    {
        return [
            'name' => '',
        ];
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
        ];
    }

}