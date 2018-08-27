<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 22.08.2018
 * Time: 4:41
 */
use yii\bootstrap\Html;
use yii\grid\GridView;
?>
    <h1>Все классы</h1>

<?php

echo GridView::widget([
    // полученные данные
    'dataProvider' => $dataProvider,
    // колонки с данными

    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'label' =>"Название класса", // название столбца
            'attribute' => 'name', // атрибут
            'filter' => [
                NULL => 'NULL'
            ],
            'value'=>function($data){return $data->name;} // объявлена анонимная функция и получен результат
        ],

        ['class' => 'yii\grid\ActionColumn'],
    ],
]);

?>