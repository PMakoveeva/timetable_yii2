<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 22.08.2018
 * Time: 5:06
 */
use yii\bootstrap\Html;
use yii\grid\GridView;
use app\models\Subject;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
$this->title = "Нагрузка для  $nameGrade";?>


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
                '<i class="glyphicon glyphicon-trash"></i>',
                \yii\helpers\Url::to(['grade/delete-sub', 'id'=>$data->id, 'grade' => $data->grade]),

                [
                    'title' => '"Это больше никогда нельзя будет вернуть"',
                    'target' => '_blank'
                ]
            );
        },
        ],
    ],
]);?>

<?php
    Modal::begin([
        'options' => [
            'id'=>'addLoad',
        ],
        'size' => 'modal-st',
        'header' => 'Добавить нагрузку',
        'toggleButton' => [
            'class' => 'btn btn-success',
            'tag' => 'Button',
            'label' => 'Добавить нагрузку'
        ],

    ]);
$items = ArrayHelper::map($subjects,'id','name');
$items[0] = 'Выберите предмет';

$param = ['options' =>[ '0' => ['Selected' => true]]];?>
<?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']])?>
<?= $form->field($load, 'subject')->dropDownList(Subject::getSubjectsList(), $param);?>
<?= $form->field($load, 'hour')?>

<?=Html::submitButton('Добавить', ['class' => 'btn btn-success form-group'])?>
<?php ActiveForm::end()?>
<?php Modal::end();
?>