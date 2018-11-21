<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 10.11.2018
 * Time: 3:56
 */

namespace app\controllers;

namespace app\controllers;
use app\models\ScheduleType;
use Yii;
use app\models\ScheduleDay;
use app\controllers\AppController;
use app\models\ScheduleTime;
use app\models\Grade;
use app\models\Schedule;


class ScheduledayController extends AppController
{
    public function actionAdd(){
        if (Yii::$app->request->isAjax) {
            $this->debug($_POST);
            return 'test';
        }
        $types = ScheduleType::getTypes();
        $day = new ScheduleDay();
        if ($day->load(Yii::$app->request->post())) {
            if ($day->save()) {
                Yii::$app->session->setFlash('success', 'Данные приняты');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка');
            }
        }


        return $this->render('add', compact('day', 'types'));
    }
    public function actionEdit(){
        $days_to_edit = Yii::$app->params['days_to_edit'];
        $last_day = ScheduleDay::getLastDay();
        $number_day = (isset($id) ? $id : $last_day->id);
        $number_day = intval($number_day);

        $day=ScheduleDay::getDay($number_day);
        $date = date('j.m.Y', $day);
        $dayName = ScheduleDay::getNameDayOfWeek(date('w', $day));

        $grades = Grade::find()->orderBy(['order' => SORT_DESC ])->AsArray()->all();
        $grade=array();
        $lessons = Schedule::getLessons($number_day);
        $lessons_id=Schedule::getLessons_id($number_day);/// массив содержащий id предметов

        $time = ScheduleDay::getSchedule_dayInTable($number_day);
        $time_start = ScheduleTime::getTime_start($number_day);
        $time_now=time()-($days_to_edit*86400);

        return $this->render('edit', compact('dayName','date', 'grades', 'time_now', 'last_day', 'number_day',
            'lessons', 'time', 'time_start', 'lessons_id', 'grade'));
    }
}