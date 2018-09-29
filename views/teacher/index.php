<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 27.08.2018
 * Time: 21:11
 */
use yii\bootstrap\Html;
use yii\grid\GridView;
use yii\helpers\Url;
$this->title = 'Учителя';
?>


<?php

echo GridView::widget([
    // полученные данные
    'dataProvider' => $dataProvider,
    // колонки с данными

    'columns' => [
        ['class' => 'yii\grid\SerialColumn',],


        [

            'label' =>"Имя", // название столбца
            'attribute' => 'name', // атрибут
            'filter' => [
                NULL => 'NULL'
            ],
            'value'=>function($data){return $data->name;} // объявлена анонимная функция и получен результат
        ],
        [
            'label' => 'Отсутствие',
            'attribute' => 'absent',
            'format' => 'raw',
            'value' => function($data){
                return Html::a(
                    'Изменить',
                    "http://timetable_yii.loc/index.php?r=teacher/absent&id=" .$data->id,
                    [
                        'title' => 'Смелей вперед!',
                        'target' => '_blank'
                    ]
                );
            }
//            'value' =>  function($data){return  (!empty($data->from) ? Yii::$app->formatter->asDate($data->from) : '');}
        ],

        [
            'class' => 'yii\grid\ActionColumn',
            'header'=>'Действия',
            'headerOptions' => ['width' => '80'],
            'template' => '{update} {delete}{link}',
        ],
    ],
]);

?>




