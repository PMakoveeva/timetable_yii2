<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 22.08.2018
 * Time: 4:36
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
$this->title = 'Добавить класс';
?>



<?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']])?>
<?= $form->field($model, 'name')?>
<?= $form->field($model, 'order')?>

<?=Html::submitButton('Добавить', ['class' => 'btn btn-success form-group'])?>
<?php ActiveForm::end()?>
