<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 08.08.2018
 * Time: 18:30
 */


namespace app\controllers;
use app\models\Teacher;
use Yii;
use app\models\TeacherForm;
class TeacherController extends AppController{

    public function actionAdd(){
        if(Yii::$app->request->isAjax){
            $this->debug($_POST);
            return 'test';
        }

        $model = new TeacherForm();

        if($model->load(Yii::$app->request->post())){
            if($model->save()){
                Yii::$app->session->setFlash('success', 'Данные приняты');
                return $this->refresh();
            }
            else{
                Yii::$app->session->setFlash('error', 'Ошибка');
            }
        }

        return $this->render('add', compact('model'));
    }

}