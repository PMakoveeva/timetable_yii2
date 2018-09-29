<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 12.08.2018
 * Time: 3:13
 */
use yii\bootstrap\Html;
use yii\grid\GridView;

$this->title = "Добавить отсутствие для $name";
?>


<?php //var_dump($teachers);
//exit();/

$items = ArrayHelper::map($reasons,'id','name');
$params = [
    'prompt'=>'Выберите причину'
];
$form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']])?>
<?= $form->field($teacher, 'from')?>
<?= $form->field($teacher, 'to')?>
<?= $form->field($teacher, 'reason')->dropDownList($items);//TODO:создать еще одну таблицу Reasons и выгружать из нее данные для причины в ворме с отсутствием
//TODO: РАзобраться вообще что происходит с отсутствием!!!?>


<?=Html::submitButton('Добавить', ['class' => 'btn btn-success form-group'])?>
<?php ActiveForm::end()?>




