<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 01.09.2018
 * Time: 15:50
 */
use yii\grid\GridView;
use yii\bootstrap\Html;
use app\models\ScheduleTime;
$this->title = "$nameType режим";
?>


<?php
//debug(function($data){return $data->subject->name;});
//    exit();

echo GridView::widget([
    // полученные данные

    'dataProvider' => $dataProvider,
    // колонки с данными

    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'label' =>"Время начала урока", // название столбца
            'attribute' => 'time_start', // атрибут
            'value' => function($data){
                return ScheduleTime::intToTime($data->time_start);
            },
        ],
        [
            'label' =>"Продолжительность урока", // название столбца
            'attribute' => 'lesson_long', // атрибут
            'value' => function($data){
                return $data->lesson_long;
            },
        ],
        [
            'label' =>"Продолжительность перемены", // название столбца
            'attribute' => 'break_long', // атрибут
            'value' => function($data){
                return $data->break_long;
            },
        ],

        [
            'class' => 'yii\grid\ActionColumn',
            'buttons' => [
                /*'delete' => function () {
                    foreach ($_GET->id as $id) {
                        return Html::a('', '\schedule\deleteTime&id=' . "$id" . '&type=' . "$type", ['class' => 'glyphicon glyphicon-trash']);

                    }
                }*/
            ],
            'header' => 'Действия',
            'template' => '{update} {delete}{link}' //TODO сделать удаление через мусорку
        ],
    ],
]);?>

<?= Html::a('Добавить время звонка', ['addtime', 'id' => $id], ['class' => 'btn btn-success']) ?>

