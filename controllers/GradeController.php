<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 22.08.2018
 * Time: 4:28
 */

namespace app\controllers;

use app\models\Grade;
use app\models\Subject;
use Yii;
use yii\data\ActiveDataProvider;
use app\models\GradeForm;
use app\models\GradeSubject;
use app\models\GradeLoadForm;



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

    public function actionDelete($id){
        $query = GradeForm::find();
        $grade = $query->where(['id' => $id])->one();
        if($grade!=null) {
            $grade->delete();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Grade::find(), // Запрос на выборку опубликованных новостей
            'sort' => [ // сортировка по умолчанию
                'defaultOrder' => ['order' => SORT_ASC],
            ],
            'pagination' => [ // постраничная разбивка
                'pageSize' => 10, // 10 новостей на странице
            ],
        ]);
        return $this->render('index', ['dataProvider' =>$dataProvider]);
    }

    public function actionDeleteSub($id){
        $grade = $_GET['grade'];
        $query = GradeForm::find();
        $grade = $query->where(['id' => $grade])->one();
        $name = $grade->name;
        $grade = $_GET['grade'];
        $subject = GradeLoadForm::find()->Where([ 'grade' => $grade, 'id' => $id])->one();
        $subjects = Subject::find()->asArray()->all();
//        $grade = $subject->grade;

        if($subject!=null) {
            $subject->delete();
        }

        $load = new GradeLoadForm();
        $gradeId = $grade;
        $load->grade=$gradeId;
        $dataProvider = new ActiveDataProvider([
            'query' => GradeSubject::find()->where(['grade' => $gradeId]), // Запрос на выборку опубликованных новостей
            'sort' => [ // сортировка по умолчанию
                'defaultOrder' => ['id' => SORT_ASC],
            ],
            'pagination' => [ // постраничная разбивка
                'pageSize' => 10, // 10 новостей на странице
            ],
        ]);
        return $this->render('view', ['dataProvider' =>$dataProvider, 'nameGrade' =>$name, 'id' => $grade,  'subjects'=>$subjects, 'load'=>$load]);

    }

    public function actionView($id){
        $query = GradeForm::find();
        $grade = $query->where(['id' => $id])->one();
        $name = $grade->name;
        $subjects = Subject::find()->asArray()->all();
        $gradeId = $id;
        $load = new GradeLoadForm();
        $load->grade=$gradeId;
        $dataProvider = new ActiveDataProvider([
            'query' => GradeSubject::find()->where(['grade' => $id]), // Запрос на выборку опубликованных новостей
            'sort' => [ // сортировка по умолчанию
                'defaultOrder' => ['id' => SORT_ASC],
            ],
            'pagination' => [ // постраничная разбивка
                'pageSize' => 10, // 10 новостей на странице
            ],
        ]);
        if ($load->load(Yii::$app->request->post())) {
            if ($load->save()) {
                Yii::$app->session->setFlash('success', 'Данные приняты');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('danger', 'Ошибка');
            }
        }
// передача экземпляра класса в представление
        return $this->render('view',['dataProvider' =>$dataProvider, 'nameGrade'=> $name, 'id' => $id, 'load'=>$load, 'subjects' => $subjects, 'grade' => $gradeId]);
    }

    public function actionAddload($id){
        if (Yii::$app->request->isAjax) {
            $this->debug($_POST);
            return 'test';
        }
        $subjects = Subject::find()->asArray()->all();
        $grade = $id;

        $load = new GradeLoadForm();
        $load->grade=$grade;

        if ($load->load(Yii::$app->request->post())) {
            if ($load->save()) {
                Yii::$app->session->setFlash('success', 'Данные приняты');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('danger', 'Ошибка');
            }
        }

        return $this->render('addLoad', compact('load', 'subjects', 'grade'));
    }
    function actionSchedule($id = null){

        if (Yii::$app->request->isAjax) {
            $this->debug($_POST);
            return 'test';
        }
        $load = new GradeForm();
        if($load->load(\Yii::$app->request->post())){
            //var_dump($load->name);
            $id = $load ->name;
            $id = (int)$id;
        }



        $allGrades = Grade::find()->asArray()->all();
        $grades = $allGrades;
        $grade = Grade::find()->where(['id' => $id])->asArray()->one();

        return $this->render('schedule', ['grade' => $grade, 'allGrades' => $allGrades, 'grades' => $grades, 'id'=>$id, 'load'=>$load]);
    }

}

