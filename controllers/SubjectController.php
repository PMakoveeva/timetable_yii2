<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 27.08.2018
 * Time: 21:29
 */

namespace app\controllers;
use app\models\SubjectForm;
use app\models\Teacher;
use Yii;
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

    function actionUpdate($id){
        if (Yii::$app->request->isAjax) {
            $this->debug($_POST);
            return 'test';
        }
        $query = SubjectForm::find();
        $teachers = Teacher::find()->asArray()->all();
        $subject = $query->where(['id' => $id])->one();

        $name = $subject->name;
        $short_name = $subject->short_name;
        $hardness = $subject->hardness;
        $teacher = $subject->teacher;
        if ($subject->load(Yii::$app->request->post())) {
            if ($subject->save()) {
                Yii::$app->session->setFlash('success', 'Данные изменены');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка');
            }
        }
        return $this->render('update',['subject' => $subject, 'name' => $name, 'short_name' => $short_name, 'hardness' => $hardness, 'teacher'=>$teacher, 'teachers' => $teachers]);
    }

}