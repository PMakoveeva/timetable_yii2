<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 20.11.2018
 * Time: 1:35
 */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Subject;
use app\models\Grade;
use app\models\Room;
$nameGrade = Grade::getGradeName($grade);
$this->title = "Добавить $order урок у $nameGrade";
$items2 = ArrayHelper::map($rooms, 'id', 'name');
$items[0] = 'Выберите предмет';

$param = ['options' =>[ '0' => ['Selected' => true]]];?>
<?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']])?>
<?= $form->field($lesson, 'subject')->dropDownList(Subject::getSubjectsList(), $param);?>
<?= $form->field($lesson, 'room')->dropDownList($items2, $param);?>
<?=Html::submitButton('Добавить', ['class' => 'btn btn-success form-group'])?>
<?php ActiveForm::end()?>