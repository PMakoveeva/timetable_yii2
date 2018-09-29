<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 30.08.2018
 * Time: 3:01
 */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Subject;

$this->title = 'Добавить нагрузку';
$items = ArrayHelper::map($subjects,'id','name');
$items[0] = 'Выберите предмет';

$param = ['options' =>[ '0' => ['Selected' => true]]];?>
<?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']])?>
<?= $form->field($load, 'subject')->dropDownList(Subject::getSubjectsList(), $param);?>
<?= $form->field($load, 'hour')?>

<?=Html::submitButton('Добавить', ['class' => 'btn btn-success form-group'])?>
<?php ActiveForm::end()?>