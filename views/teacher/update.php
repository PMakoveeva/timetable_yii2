<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 20.08.2018
 * Time: 2:38
 */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Внести изменения';
?>


<?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']])?>
<?= $form->field($teacher, 'name')->textInput(['value' => $name])?>

<?=Html::submitButton('Изменить', ['class' => 'btn btn-success form-group'])?>
<?php ActiveForm::end()?>

