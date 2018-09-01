<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 01.09.2018
 * Time: 15:49
 */
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;?>


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
<?= $form->field($type, 'type_name')->textInput(['value' => $type_name])?>

<?=Html::submitButton('Обновить', ['class' => 'btn btn-success form-group'])?>
<?php ActiveForm::end();?>
