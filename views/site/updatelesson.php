<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 21.11.2018
 * Time: 12:37
 */
use yii\helpers\ArrayHelper;
use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use app\models\Subject;
$this->title = 'Внести изменения';?>
<?php
$params = [];
$less = \app\models\Schedule::find()->where(['id' => $id])->one();
$subject = $less->subject;
$form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']])?>
<?= $form->field($lesson, 'subject')->textInput(['value' => $subject])->dropDownList(Subject::getSubjectsList())?>
<?= $form->field($lesson, 'room')->textInput(['value' => $room])->dropDownList($rooms)?>

<?=Html::submitButton('Изменить', ['class' => 'btn btn-success form-group'])?>
<?php ActiveForm::end()?>