<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 01.09.2018
 * Time: 16:02
 */

namespace app\controllers;
use app\models\Schedule;
use app\models\ScheduleType;
use app\models\ScheduleLessonForm;
use Yii;
use app\models\Room;
use app\models\ScheduleTime;
use app\models\ScheduleTypeForm;
use app\controllers\AppController;
use yii\data\ActiveDataProvider;
use app\models\TimeForm;
use app\models\Subject;

class ScheduleController extends AppController{
     public function actionIndex(){
         $dataProvider = new ActiveDataProvider([
             'query' => ScheduleType::find(),
             'sort' => [
                 'defaultOrder' => ['type_name' => SORT_ASC],
             ],
             'pagination' => [
                 'pageSize' => 10,
             ],
         ]);
         return $this->render('index',['dataProvider' =>$dataProvider]);
     }

     public function actionAdd(){
         if (Yii::$app->request->isAjax) {
             $this->debug($_POST);
             return 'test';
         }

         $type = new ScheduleTypeForm();

         if ($type->load(Yii::$app->request->post())) {
             if ($type->save()) {
                 Yii::$app->session->setFlash('success', 'Данные приняты');
                 return $this->refresh();
             } else {
                 Yii::$app->session->setFlash('error', 'Ошибка');
             }
         }

         return $this->render('add', compact('type'));
     }
     public function actionUpdate($id){
         $query = ScheduleTypeForm::find();
         $type = $query->where(['id' => $id])->one();

         $type_name = $type->type_name;
         if ($type->load(Yii::$app->request->post())) {
             if ($type->save()) {
                 Yii::$app->session->setFlash('success', 'Данные изменены');
                 return $this->refresh();
             } else {
                 Yii::$app->session->setFlash('error', 'Ошибка');
             }
         }
         return $this->render('update',['type' => $type, 'type_name' => $type_name]);

     }

     public function actionDelete($id){
         $query = ScheduleTypeForm::find();
         $type = $query->where(['id' => $id])->one();
         if($type!=null) {
             $type->delete();
         }

         $dataProvider = new ActiveDataProvider([
             'query' => ScheduleType::find(), // Запрос на выборку опубликованных новостей
             'sort' => [ // сортировка по умолчанию
                 'defaultOrder' => ['type_name' => SORT_ASC],
             ],
             'pagination' => [ // постраничная разбивка
                 'pageSize' => 10, // 10 новостей на странице
             ],
         ]);
         return $this->render('index', ['dataProvider' =>$dataProvider]);
     }

     public function actionView($id){
         $query = ScheduleType::find();
         $grade = $query->where(['id' => $id])->one();
         $name = $grade->type_name;
         $dataProvider = new ActiveDataProvider([
             'query' => ScheduleTime::find()->where(['schedule_type' => $id]),
             'sort' => [ // сортировка по умолчанию
                 'defaultOrder' => ['time_start' => SORT_ASC],
             ],
             'pagination' => [
                 'pageSize' => 12,
             ],
         ]);
// передача экземпляра класса в представление
         return $this->render('view',['dataProvider' =>$dataProvider, 'nameType'=> $name, 'id' => $id]);
     }

     public function actionAddtime($id){
         $time = new TimeForm();
         $time->schedule_type=$id;
         $type = ScheduleType::findOne($id);
         $name = $type->type_name;

         if ($time->load(Yii::$app->request->post())) {
             $time->time_start=ScheduleTime::TimeToInt($time->time_start);
             if ($time->save()) {
                 Yii::$app->session->setFlash('success', 'Данные приняты');
                 return $this->refresh();
             } else {
                 Yii::$app->session->setFlash('danger', 'Ошибка');
             }
         }

         return $this->render('addTime', compact('time', 'name'));
     }

     public function actionDeleteTime($id, $type){//TODO нужно чтобы в ссылке был тип расписания

             $query = TimeForm::find();
             $time = $query->where(['id' => $id])->one();
             if($time!=null) {
                 $time->delete();
             }

         $dataProvider = new ActiveDataProvider([
             'query' => ScheduleTime::find()->where(['schedule_type' => $type]),
             'sort' => [ // сортировка по умолчанию
                 'defaultOrder' => ['time_start' => SORT_ASC],
             ],
             'pagination' => [
                 'pageSize' => 12,
             ],
         ]);
             return $this->render('view', ['dataProvider' => $dataProvider, 'id' => $id]);

     }
    public function actionAddlesson($grade, $order, $day){
        if (Yii::$app->request->isAjax) {
            $this->debug($_POST);
            return 'test';
        }


        $subject = Subject::find()->asArray()->all();
        $lesson = new ScheduleLessonForm();
        $lesson -> grade = $grade;
        $lesson -> order = $order;
        $lesson -> day = $day;
        $rooms = Room::find()->orderBy(['name' => SORT_ASC])->asArray()->all();

        if ($lesson->load(Yii::$app->request->post())) {
            if ($lesson->save()) {
                Yii::$app->session->setFlash('success', 'Данные приняты');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка');
            }
        }

        return $this->render('addlesson', ['subject' => $subject, 'lesson' => $lesson, 'order' => $order, 'grade' => $grade, 'rooms' => $rooms]);
    }
}