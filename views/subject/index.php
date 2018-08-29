<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 27.08.2018
 * Time: 21:54
 */
use yii\grid\GridView;
use app\models\Teacher;?>

<h1>Предметы</h1>

<?php

echo GridView::widget([
    // полученные данные
    'dataProvider' => $dataProvider,
    // колонки с данными

    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'label' =>"Название предмета",
            'attribute' => 'name',
            'value'=>function($data){return $data->name;}
        ],
        [
            'label' =>"Сокращение",
            'attribute' => 'short_name',
            'value'=>function($data){return $data->short_name;}
        ],
        [
            'label' =>"Сложность",
            'attribute' => 'hardness',
            'value'=>function($data){return $data->hardness;}
        ],
        [
            'label' => 'Учитель',
            'attribute' => 'teacher',
            'value' =>  function($data){
                return Teacher::findOne($data->teacher)->name;
            }
        ],

        ['class' => 'yii\grid\ActionColumn',
            'header' => 'Действия',
            'template' => '{update} {delete}{link}'],
    ],
]);

?>
