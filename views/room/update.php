<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 01.09.2018
 * Time: 4:07
 *
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
$this->title = 'Внести изменения';?>



<?php
$items = ArrayHelper::map($teachers,'id','name');
$params = [];
$form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']])?>
<?= $form->field($room, 'name')->textInput(['value' => $name])?>
<?= $form->field($room, 'teacher')->dropDownList($items);?>

<?=Html::submitButton('Изменить', ['class' => 'btn btn-success form-group'])?>
<?php ActiveForm::end()?>