<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 12.08.2018
 * Time: 3:13
 */
use yii\bootstrap\Html;
use yii\grid\GridView;
?>
<h1>Добавить отсутствие для <?= $name?></h1>

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
//exit();/

$items = ArrayHelper::map($reasons,'id','name');
$params = [
    'prompt'=>'Выберите причину'
];
$form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']])?>
<?= $form->field($teacher, 'from')?>
<?= $form->field($teacher, 'to')?>
<?= $form->field($teacher, 'reason')->dropDownList($items);//TODO:создать еще одну таблицу Reasons и выгружать из нее данные для причины в ворме с отсутствием
//TODO: РАзобраться вообще что происходит с отсутствием!!!?>


<?=Html::submitButton('Добавить', ['class' => 'btn btn-success form-group'])?>
<?php ActiveForm::end()?>




