<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 01.09.2018
 * Time: 4:08
 */
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;

$this->title = 'Добавить новый кабинет';
?>
<?php
$items = ArrayHelper::map($teachers,'id','name');

$items[0] = 'Выберите учителя';

$param = ['options' =>[ '0' => ['Selected' => true]]];?>
<?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']])?>
<?= $form->field($room, 'name')?>
<?= $form->field($room, 'teacher')->dropDownList($items, $param)?>

<?=Html::submitButton('Добавить', ['class' => 'btn btn-success form-group'])?>
<?php ActiveForm::end()?>