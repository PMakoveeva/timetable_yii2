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
$this->title = 'Добавить новый прелмет';?>



<?php //var_dump($teachers);
//exit();
$items = ArrayHelper::map($teachers,'id','name');

$items[0] = 'Выберите учителя';

$param = ['options' =>[ '0' => ['Selected' => true]]];?>
<?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']])?>
<?= $form->field($subject, 'name')?>
<?= $form->field($subject, 'short_name')?>
<?= $form->field($subject, 'teacher')->dropDownList($items, $param);?>
<?= $form->field($subject, 'hardness')?>

<?=Html::submitButton('Добавить', ['class' => 'btn btn-success form-group'])?>
<?php ActiveForm::end()?>
