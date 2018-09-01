<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 01.09.2018
 * Time: 4:00
 */

namespace app\controllers;
use app\models\Room;
use Yii;
use app\models\Teacher;
use app\models\RoomForm;
use yii\data\ActiveDataProvider;

use app\controllers\AppController;
class RoomController extends AppController{


    public function actionIndex(){
        $dataProvider = new ActiveDataProvider([
            'query' => Room::find(), // Запрос на выборку опубликованных новостей
            'sort' => [ // сортировка по умолчанию
                'defaultOrder' => ['name' => SORT_ASC],
            ],
            'pagination' => [ // постраничная разбивка
                'pageSize' => 10, // 10 новостей на странице
            ],
        ]);
// передача экземпляра класса в представление
        return $this->render('index',['dataProvider' =>$dataProvider]);
    }

    public function actionAdd(){
        if (Yii::$app->request->isAjax) {
            $this->debug($_POST);
            return 'test';
        }
        $teachers = Teacher::find()->asArray()->all();
        $room = new RoomForm();
        if ($room->load(Yii::$app->request->post())) {
            if ($room->save()) {
                Yii::$app->session->setFlash('success', 'Данные приняты');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка');
            }
        }

        return $this->render('add', compact('room', 'teachers'));
    }

    public function actionDelete($id){

        $query = RoomForm::find();
        $room = $query->where(['id' => $id])->one();
        if($room!=null) {
            $room->delete();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Room::find(),
            'sort' => [
                'defaultOrder' => ['name' => SORT_ASC],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $this->render('index', ['dataProvider' =>$dataProvider]);
    }

    public function actionUpdate($id){
        if (Yii::$app->request->isAjax) {
            $this->debug($_POST);
            return 'test';
        }
        $query = RoomForm::find();
        $teachers = Teacher::find()->asArray()->all();
        $room = $query->where(['id' => $id])->one();

        $name = $room->name;
        $teacher = $room->teacher;
        if ($room->load(Yii::$app->request->post())) {
            if ($room->save()) {
                Yii::$app->session->setFlash('success', 'Данные изменены');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка');
            }
        }
        return $this->render('update',compact('room', 'name', 'teacher', 'teachers'));
    }
}