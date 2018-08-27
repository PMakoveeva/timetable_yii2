<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 22.08.2018
 * Time: 4:28
 */

namespace app\controllers;

use app\models\Grade;
use Yii;
use yii\data\ActiveDataProvider;
use app\models\GradeForm;
use app\models\GradeSubject;


class GradeController extends AppController
{
    function actionIndex(){
        $dataProvider = new ActiveDataProvider([
            'query' => Grade::find(),
            'sort' => [
                'defaultOrder' => ['order' => SORT_ASC],
            ],
            'pagination' => [ // постраничная разбивка
                'pageSize' => 10,
            ],
        ]);
        return $this->render('index',['dataProvider' =>$dataProvider]);
    }

    function actionAdd(){
        if (Yii::$app->request->isAjax) {
            $this->debug($_POST);
            return 'test';
        }

        $model = new GradeForm();

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

    function actionUpdate($id){
        if (Yii::$app->request->isAjax) {
            $this->debug($_POST);
            return 'test';
        }
        $query = GradeForm::find();
        $grade = $query->where(['id' => $id])->one();
        $name = $grade->name;
        $order = $grade->order;
        if ($grade->load(Yii::$app->request->post())) {
            if ($grade->save()) {
                Yii::$app->session->setFlash('success', 'Данные изменены');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка');
            }
        }
        return $this->render('update',['name' => $name, 'grade'=>$grade, 'order' => $order]);
    }

    function actionView($id){
        $query = GradeForm::find();
        $grade = $query->where(['id' => $id])->one();
        $name = $grade->name;
        $dataProvider = new ActiveDataProvider([
            'query' => GradeSubject::find()->where(['grade' => $id]), // Запрос на выборку опубликованных новостей
            'sort' => [ // сортировка по умолчанию
                'defaultOrder' => ['id' => SORT_ASC],
            ],
            'pagination' => [ // постраничная разбивка
                'pageSize' => 10, // 10 новостей на странице
            ],
        ]);
// передача экземпляра класса в представление
        return $this->render('view',['dataProvider' =>$dataProvider, 'nameGrade'=> $name]);
    }

}

