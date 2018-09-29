<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 01.09.2018
 * Time: 15:53
 */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\models\ScheduleTime;

$this->title = "Добавить время звонка / $name режима";

$form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']])?>
<?= $form->field($time, 'time_start')?>
<?= $form->field($time, 'lesson_long')?>
<?= $form->field($time, 'break_long')?>
<?=Html::submitButton('Добавить', ['class' => 'btn btn-success form-group'])?>
<?php ActiveForm::end()?>