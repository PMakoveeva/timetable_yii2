<?php

namespace app\controllers;

use app\models\ScheduleDay;
use app\models\ScheduleTime;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Grade;
use app\models\Schedule;
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
