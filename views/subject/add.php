<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 28.08.2018
 * Time: 0:36
 */
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Html;
$this->title = 'Добавить новый предмет';?>
<?php //var_dump($teachers);
//exit();
$items = ArrayHelper::map($teachers,'id','name');


$param = ['options' =>[ '0' => ['Selected' => true]]];?>
<?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']])?>
<?= $form->field($subject, 'name')?>
<?= $form->field($subject, 'short_name')?>
<?= $form->field($subject, 'teacher')->dropDownList($items, $param);?>
<?= $form->field($subject, 'group')->dropDownList([
'0' => '1',
'1' => '2',
]);?>
<?=Html::submitButton('Добавить', ['class' => 'btn btn-success form-group'])?>
<?php ActiveForm::end()?>
