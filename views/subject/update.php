<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 27.08.2018
 * Time: 22:37
 */
use yii\helpers\ArrayHelper;
use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Внести изменения';?>





<?php //var_dump($teachers);
//exit();
$items = ArrayHelper::map($teachers,'id','name');
$params = [];
$form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']])?>
<?= $form->field($subject, 'name')->textInput(['value' => $name])?>
<?= $form->field($subject, 'short_name')->textInput(['value' => $short_name])?>
<?= $form->field($subject, 'teacher')->dropDownList($items);?>
<?= $form->field($subject, 'hardness')->textInput(['value' => $hardness])?>

<?=Html::submitButton('Изменить', ['class' => 'btn btn-success form-group'])?>
<?php ActiveForm::end()?>