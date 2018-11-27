<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 10.11.2018
 * Time: 4:01
 */
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
$this->title = 'Добавить день';?>



<?php
$items = ArrayHelper::map($types,'id','type_name');
$items[0] = 'Выберите тип расписания';

$param = ['options' =>[ '0' => ['Selected' => true]]];?>
<?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']])?>
<?= $form -> field ( $day , 'day' ) -> widget ( DatePicker :: classname (), [
    'type' => DatePicker::TYPE_COMPONENT_APPEND,
    'pluginOptions' => [
        'todayHighlight' => true,
        'format' => 'yyyy/mm/dd',
        'autoclose' => true
    ]
]);?>
<?= $form->field($day, 'type')->dropDownList($items, $param);?>
<?=Html::submitButton('Добавить', ['class' => 'btn btn-success form-group'])?>
<?php ActiveForm::end()?>

