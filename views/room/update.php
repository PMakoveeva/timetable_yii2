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
use yii\helpers\ArrayHelper;?>
<h1>Внести изменения</h1>


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

<?php
$items = ArrayHelper::map($teachers,'id','name');
$params = [];
$form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']])?>
<?= $form->field($room, 'name')->textInput(['value' => $name])?>
<?= $form->field($room, 'teacher')->dropDownList($items);?>

<?=Html::submitButton('Изменить', ['class' => 'btn btn-success form-group'])?>
<?php ActiveForm::end()?>