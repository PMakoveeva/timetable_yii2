<?php

namespace app\controllers;

use app\models\ScheduleDay;
use app\models\ScheduleTime;
use app\models\Teacher;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Grade;
use app\models\Schedule;
use app\models\Subject;
use app\models\Room;
use app\models\ScheduleLessonForm;
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    public function actionIndex($id = null)
    {
        $days_to_edit = Yii::$app->params['days_to_edit'];
        $last_day = ScheduleDay::getLastDay();
        $number_day = (isset($id) ? $id : $last_day->id);
        $number_day = intval($number_day);


        $day=ScheduleDay::getDay($number_day);
        var_dump($day);
        $date = date('j.m.Y', $day);
        $dayName = ScheduleDay::getNameDayOfWeek(date('w', $day));

        $grades = Grade::find()->orderBy(['order' => SORT_DESC ])->AsArray()->all();
        $grade=array();
        $lessons = Schedule::getLessons($number_day);
        $lessons_id=Schedule::getLessons_id($number_day);/// массив содержащий id предметов

        $time = ScheduleDay::getSchedule_dayInTable($number_day);
        $time_start = ScheduleTime::getTime_start($number_day);
        $time_now=time()-($days_to_edit*86400);

        /*$idLess = ;
        $lesson = ScheduleLessonForm::find()->where(['id' => $idLess])->one();//переделать ID

        $subject = $lesson->subject;
        $roomId = $lesson -> room;
        $room = Room::getNameRoom($roomId);
        $order = $lesson->order;
        $rooms = Room::GetEmptyRoom($day, $order);*/

        return $this->render('index', compact('dayName','date','day', 'grades', 'time_now', 'last_day', 'number_day',
            'lessons', 'time', 'time_start', 'lessons_id', 'grade'));
    }

    public function actionAddlesson($grade, $order, $day){
        $subject = Subject::find()->asArray()->all();
        $lesson = new ScheduleLessonForm();
        $lesson -> grade = $grade;
        $lesson -> order = $order;
        $lesson -> day = $day;
        $rooms = Room::GetEmptyRoom($day, $order);

        if ($lesson->load(Yii::$app->request->post())) {
            /*var_dump($lesson->subject);
            exit();*/
            $gradeQ = Grade::getGradeName($lesson->grade);
            $subjectQ = $lesson->subject;
            $lessonQ = $lesson;
            $res = Teacher::getTeacher(Subject::getTeacher($subjectQ));
            $teacherQ = $res['id'];
            if ($lessonQ = Schedule::hasRepeat($gradeQ, $subjectQ, $order, $day)) {
                $teach = Teacher::getTeacher(Subject::getTeacher($subject));
                $sub1 = Subject::find()->where(['teacher' => $teacherQ])->one();
                $sub = $sub1->id;
                /*$ret = Schedule::find()->where(['IN', 'subject', $sub])->andWhere(['order' => $order, 'day' => $day])->one();*/
                /*var_dump($ret);
                exit();
                $grade12 = Grade::getGradeName($ret->grade);*/
                $ret = Schedule::find()->where(['order' => $order, 'day' => $day, 'subject' => $sub])->one();
                $grade12 = Grade::getGradeName($ret -> grade);

                $res = Teacher::getTeacher(Subject::getTeacher($subjectQ));
                $teacherQ = $res['name'];

                Yii::$app->session->setFlash('danger', "Совпадение уроков! В этот день у $teacherQ уже стоит $lesson->order урок у $grade12");
                return $this->refresh();
            } else
                if($lesson->save()){
                    Yii::$app->session->setFlash('success', 'Данные приняты');
                    return $this->refresh();
                }
            }

            return $this->render('addlesson', ['subject' => $subject, 'lesson' => $lesson, 'order' => $order, 'grade' => $grade, 'rooms' => $rooms, 'day' => $day]);
        }

        public function actionUpdatelesson($id){
            $lesson = ScheduleLessonForm::find()->where(['id' => $id])->one();

            $subject = $lesson->subject;
            $roomId = $lesson -> room;
            $room = Room::getNameRoom($roomId);
            $day = $lesson->day;
            $order = $lesson->order;
            $rooms = Room::GetEmptyRoom($day, $order);
            /*var_dump($rooms);
            exit();*/

            if ($lesson->load(Yii::$app->request->post())) {
                if ($lesson->save()) {
                    Yii::$app->session->setFlash('success', 'Данные приняты');
                    return $this->refresh();
                } else {
                    Yii::$app->session->setFlash('error', 'Ошибка');
                }
            }

            return $this->render('updatelesson', ['subject' => $subject, 'lesson' => $lesson, 'id' => $id, 'room' => $room, 'rooms'=> $rooms]);
        }

        public function actionDeletelesson($id){
            $dayId = Schedule::find()->where(['id' => $id])->one()->day;
            $lesson = ScheduleLessonForm::find()->where(['id' => $id])->one();
            if($lesson!=null) {
                $lesson->delete();
            }

            $days_to_edit = Yii::$app->params['days_to_edit'];
            $last_day = ScheduleDay::getLastDay();
            $number_day = (isset($dayId) ? $dayId : $last_day->id);
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

            return $this->render('index', compact('dayName','date','day', 'grades', 'time_now', 'last_day', 'number_day',
                'lessons', 'time', 'time_start', 'lessons_id', 'grade'));
        }


        public function actionLogin()
        {
            if (!Yii::$app->user->isGuest) {
                return $this->goHome();
            }

            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                return $this->goBack();
            }

            $model->password = '';
            return $this->render('login', [
                'model' => $model,
            ]);
        }

        /**
         * Logout action.
         *
         * @return Response
         */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
