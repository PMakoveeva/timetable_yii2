<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 12.08.2018
 * Time: 3:13
 */
use yii\bootstrap\Html;
use yii\grid\GridView;


echo GridView::widget([
    // полученные данные
    'dataProvider' => $dataProvider,
    // колонки с данными

    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'label' =>"Имя", // название столбца
            'attribute' => 'name', // атрибут
            'filter' => [
                NULL => 'NULL'
            ],
            'value'=>function($data){return $data->name;} // объявлена анонимная функция и получен результат
        ],
        [
            'label' => 'Добавить отсутствие',
            'attribute' => 'absent',
            'value' =>  function($data){return  $data->from;}
        ],

        ['class' => 'yii\grid\ActionColumn'],
    ],
]);

?>

<h1>Отсутствие</h1>


