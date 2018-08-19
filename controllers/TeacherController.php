<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 08.08.2018
 * Time: 18:30
 */


namespace app\controllers;
use app\models\Teacher;
use app\models\UpdateTeacherForm;
use Yii;
use yii\data\ActiveDataProvider;

use app\models\AddTeacherForm;
class TeacherController extends AppController
{

    public function actionAdd()
    {
        if (Yii::$app->request->isAjax) {
            $this->debug($_POST);
            return 'test';
        }

        $model = new AddTeacherForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Данные приняты');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка');
            }
        }

        return $this->render('add', compact('model'));
    }

 /*   public function actionAbsent()
    {


    }*/
    function actionAbsent()
    {
        //$query = Teacher::find();

//        $teachers = $query->orderBy('name')->asArray()->all();
        $dataProvider = new ActiveDataProvider([
            'query' => Teacher::find(), // Запрос на выборку опубликованных новостей
            'sort' => [ // сортировка по умолчанию
                'defaultOrder' => ['name' => SORT_ASC],
            ],
            'pagination' => [ // постраничная разбивка
                'pageSize' => 10, // 10 новостей на странице
            ],
        ]);
// передача экземпляра класса в представление
        return $this->render('absent',['dataProvider' =>$dataProvider]);
    }
    function actionUpdate($id){
        if (Yii::$app->request->isAjax) {
            $this->debug($_POST);
            return 'test';
        }
        $query = AddTeacherForm::find();
        $teacher = $query->where(['id' => $id])->one();
        $name = $teacher->name;
        if ($teacher->load(Yii::$app->request->post())) {
            if ($teacher->save()) {
                Yii::$app->session->setFlash('success', 'Данные изменены');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка');
            }
        }
        return $this->render('update',['name' => $name, 'teacher'=>$teacher]);
    }
}