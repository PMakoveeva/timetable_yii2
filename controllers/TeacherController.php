<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 08.08.2018
 * Time: 18:30
 */


namespace app\controllers;
use app\models\SelectTeacherForm;
use app\models\Teacher;
use Yii;
use yii\data\ActiveDataProvider;

use app\models\TeacherForm;
class TeacherController extends AppController
{

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Teacher::find(),
            'sort' => [
                'defaultOrder' => ['name' => SORT_ASC],
            ],
            'pagination' => [
                'pageSize' => Yii::$app->params['teachersOnPage'],
            ],
        ]);
        return $this->render('index',['dataProvider' =>$dataProvider]);
    }
    public function actionAdd()
    {
        $model = new TeacherForm();
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
    function actionAbsent($id)
    {
        $teacher = Teacher::findOne($id);
        $name = $teacher->name;
        $dataProvider = new ActiveDataProvider([
            'query' => Teacher::find(),

            'sort' => [
                'defaultOrder' => ['name' => SORT_ASC],
            ],
            'pagination' => [
                'pageSize' => Yii::$app->params['teachersOnPage'],
            ],
        ]);
        return $this->render('absent',['dataProvider' =>$dataProvider, 'id' => $id, 'name' => $name]);
    }
    function actionUpdate($id){
        if (Yii::$app->request->isAjax) {
            $this->debug($_POST);
            return 'test';
        }
        $query = TeacherForm::find();
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

    function actionDelete($id){
        $query = TeacherForm::find();
        $teacher = $query->where(['id' => $id])->one();
        if($teacher!=null) {
            $teacher->delete();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Teacher::find(), // Запрос на выборку опубликованных новостей
            'sort' => [ // сортировка по умолчанию
                'defaultOrder' => ['name' => SORT_ASC],
            ],
            'pagination' => [ // постраничная разбивка
                'pageSize' => Yii::$app->params['teachersOnPage'],
            ],
        ]);
      return $this->render('index', ['dataProvider' =>$dataProvider]);
    }
    function actionSchedule($id = null){

        if (Yii::$app->request->isAjax) {
            $this->debug($_POST);
            return 'test';
        }
        $load = new SelectTeacherForm();
        if($load->load(\Yii::$app->request->post())){

            var_dump($load->name);
            $id = $load ->name;
            $id = (int)$id;
        }



        $allTeachers = Teacher::find()->asArray()->all();
        $teachers = $allTeachers;
        $teacher = Teacher::getTeacher($id);

        return $this->render('schedule', ['teacher' => $teacher, 'allTeachers' => $allTeachers, 'teachers' => $teacher, 'id'=>$id, 'load'=>$load]);
    }
}