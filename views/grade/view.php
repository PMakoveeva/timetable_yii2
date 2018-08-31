<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 22.08.2018
 * Time: 5:06
 */
use yii\bootstrap\Html;
use yii\grid\GridView;
use app\models\Subject;?>
<h1>Нагрузка для <?=$nameGrade?></h1>

<?php
//debug(function($data){return $data->subject->name;});
//    exit();

echo GridView::widget([
    // полученные данные

    'dataProvider' => $dataProvider,
    // колонки с данными

    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
//        'grade.subject.name',
        [
            'label' =>"Название предмета", // название столбца
            'attribute' => 'subject', // атрибут
            'value' => function($data){
                return Subject::findOne($data->subject)->name;
            },
//            'content'=>'parent.name',


        ],
        [
        'label' =>"Часов в неделю", // название столбца
            'attribute' => 'hour', // атрибут
            'filter' => [
                NULL => 'NULL'
            ],
            'value'=>function($data){return $data->hour;} // объявлена анонимная функция и получен результат
        ],
        [
        'label' =>"удалить",
        'attribute' => 'delete',
        'format' => 'raw',
        /*<span class="glyphicon glyphicon-trash"></span>*/
        'value' => function($data){
            return Html::a(
                'удалить',
                "http://timetable_yii.loc/index.php?r=grade/delete_sub&id=" .$data->id . '&grade=' . $data->grade,
                [
                    'title' => '"Это больше никогда нельзя будет вернуть"',
                    'target' => '_blank'
                ]
            );
        },
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => null,//TODO: убрать пустой столбец
        ],
    ],
]);?>

<?= Html::a('Добавить нагрузку', ['addload', 'id' => $id], ['class' => 'btn btn-success']) ?>


