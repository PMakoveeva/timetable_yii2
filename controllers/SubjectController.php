<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 27.08.2018
 * Time: 21:29
 */

namespace app\controllers;

use yii\data\ActiveDataProvider;
use app\models\Subject;

class SubjectController extends AppController
{
    function actionIndex(){
        $dataProvider = new ActiveDataProvider([
            'query' => Subject::find(),
            'sort' => [
                'defaultOrder' => ['name' => SORT_ASC],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $this->render('index',['dataProvider' =>$dataProvider]);
    }

}