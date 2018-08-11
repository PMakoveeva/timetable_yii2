<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>

<h1>Добавить учителя</h1>
<?php if(Yii::$app->session->hasFlash('success')):?>
    <div class="alert alert-success alert-dismissible " role="alert">

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo Yii::$app->session->getFlash('success')?>
    </div>
<?php endif;?>

<?php  if(Yii::$app->session->hasFlash('error')):?>
    <div class="alert alert-danger alert-dismissible " role="alert">

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo Yii::$app->session->getFlash('error')?>

    </div>
<?php endif;?>


<?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']])?>
<?= $form->field($model, 'name')?>

<?=Html::submitButton('Добавить', ['class' => 'btn btn-success form-group'])?>
<?php ActiveForm::end()?>

