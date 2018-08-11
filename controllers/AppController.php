<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 03.08.2018
 * Time: 11:15
 */
namespace app\controllers;
use yii\web\Controller;

class AppController extends Controller{

    public function debug($arr){
        echo '<pre>' .print_r($arr, true). '</pre>';
    }

}
