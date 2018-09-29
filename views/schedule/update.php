<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 01.09.2018
 * Time: 15:49
 */
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
$this->title = 'Внести изменения';?>




<?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']])?>
<?= $form->field($type, 'type_name')->textInput(['value' => $type_name])?>

<?=Html::submitButton('Обновить', ['class' => 'btn btn-success form-group'])?>
<?php ActiveForm::end();?>
