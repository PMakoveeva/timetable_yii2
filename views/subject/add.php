<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 28.08.2018
 * Time: 0:36
 */
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Html;?>
<h1>Добавить новый предмет</h1>


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

<?php //var_dump($teachers);
//exit();
$items = ArrayHelper::map($teachers,'id','name');
$params = [
    'prompt'=>'Выберите учителя'
];
$form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']])?>
<?= $form->field($subject, 'name')?>
<?= $form->field($subject, 'short_name')?>
<?= $form->field($subject, 'teacher')->dropDownList($items);?>
<?= $form->field($subject, 'hardness')?>

<?=Html::submitButton('Добавить', ['class' => 'btn btn-success form-group'])?>
<?php ActiveForm::end()?>
