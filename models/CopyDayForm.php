<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 05.01.2019
 * Time: 1:41
 */
namespace app\models;
use yii\db\ActiveRecord;
use yii\base\Model;



class CopyDayForm extends Model
{
    public $id;
    public $day;
    public  function rules()
    {
        return [
            ['id', 'required'],
        ];

    }


}