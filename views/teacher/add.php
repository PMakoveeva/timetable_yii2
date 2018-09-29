<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
$this->title = 'Добавить учителя';
?>



<?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']])?>
<?= $form->field($model, 'name')?>

<?=Html::submitButton('Добавить', ['class' => 'btn btn-success form-group'])?>
<?php ActiveForm::end()?>

