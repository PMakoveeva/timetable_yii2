<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 01.09.2018
 * Time: 4:07
 */
use app\models\Teacher;
use yii\grid\GridView;
$this->title = 'Кабинеты';?>


<?php

echo GridView::widget([
    // полученные данные
    'dataProvider' => $dataProvider,
    // колонки с данными

    'columns' => [
        ['class' => 'yii\grid\SerialColumn',],


        [

            'label' =>"Номер кабинета", // название столбца
            'attribute' => 'name', // атрибут
            'value'=>function($data){return $data->name;} // объявлена анонимная функция и получен результат
        ],
        [
            'label' => 'Учитель',
            'attribute' => 'teacher',
            'value' =>  function($data){
//                var_dump(Teacher::findOne($data->teacher)->name);
//                exit();

                $teacher = Teacher::find()->where(['id' => $data->teacher])->asArray()->one();
                return $teacher['name'];

            }
        ],

        [
            'class' => 'yii\grid\ActionColumn',
            'header'=>'Действия',
            'headerOptions' => ['width' => '80'],
            'template' => '{update} {delete}{link}',
        ],
    ],
]);