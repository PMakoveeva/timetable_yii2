<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 01.09.2018
 * Time: 15:48
 */

use yii\grid\GridView;
?>
<h1>Режимы расписания</h1>

<?php

echo GridView::widget([
    // полученные данные
    'dataProvider' => $dataProvider,
    // колонки с данными

    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'label' =>"Название режима расписания",
            'attribute' => 'name',
            'value'=>function($data){return $data->type_name;}
        ],


        ['class' => 'yii\grid\ActionColumn',
            'header' => 'Действия',
            'template' => '{view} {update} {delete}{link}'],
    ],
]);

?>
