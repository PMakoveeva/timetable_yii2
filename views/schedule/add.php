<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 01.09.2018
 * Time: 15:49
 */
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
$this->title = 'Добавить тип расписания';?>



<?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']])?>
<?= $form->field($type, 'type_name')?>

<?=Html::submitButton('Добавить', ['class' => 'btn btn-success form-group'])?>
<?php ActiveForm::end()?>
