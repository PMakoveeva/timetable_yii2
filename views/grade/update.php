<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 22.08.2018
 * Time: 4:52
 */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Внести изменения';
?>


<?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']])?>
<?= $form->field($grade, 'name')->textInput(['value' => $name])?>
<?= $form->field($grade, 'order')->textInput(['value' => $order])?>

<?=Html::submitButton('Изменить', ['class' => 'btn btn-success form-group'])?>
<?php ActiveForm::end()?>

