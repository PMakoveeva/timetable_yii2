<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 04.01.2019
 * Time: 15:15
 */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Subject;
use app\models\Grade;
use app\models\Room;
use app\models\Schedule;
$this->title = 'Скопировать данные для '. $date ."  ". $dayName ;
$param = ['options' =>[ '0' => ['Selected' => true]]];?>
<?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']])?>
<?= $form->field($load, 'id')->dropDownList(\app\models\ScheduleDay::getDaysLimit(), $param);?>
<?=Html::submitButton('Скопировать', ['class' => 'btn btn-success form-group'])?>
<?php ActiveForm::end()?>