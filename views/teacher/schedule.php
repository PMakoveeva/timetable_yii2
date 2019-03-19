<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 29.09.2018
 * Time: 9:29
 */
use yii\bootstrap\ActiveForm;
use app\models\Teacher;
use app\models\ScheduleDay;
use app\models\Schedule;
use app\models\ScheduleTime;
use app\models\Grade;
use app\models\Subject;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;



if($id!='') {
$title = 'Расписание для ' . $teacher['name'];
}
else{
$title='Расписание для учителя';
}
?>
<h1><?=$title?></h1>

<div class="container">



        <?php $param = ['options' =>[ '0' => ['Selected' => true]]];
        $form = ActiveForm::begin();?>
            <?=$form->field($load, 'name')->dropDownList(Teacher::getTeachersList(), $param);?>
            <?=Html::submitButton('Выбрать', ['class' => 'btn btn-success']);?>
        <?php ActiveForm::end();?>


    <?php if($id!=''): ?>
        <div class="row">
            <?php foreach (ScheduleDay::getDayslimit6() as $day): ?>
                <div class="col-md-4 col-lg-2 ">
                    <?php /*var_dump($day);
                    */?>
                    <h3><?=date('j.m', $day)?> <?=ScheduleDay::getShortNameDayOfWeek(date('w', $day))?></h3>
                    <div class="table-responsive">
                        <table class="table table-bordered teacher-schedule">
                            <thead>

                            </thead>
                            <tbody>
                            <tr>

                                <?php  foreach (Schedule::getSubjectTeacher($teachers['id'], $day) as $subTeach):?>

                                <th><?=ScheduleTime::intToTime(ScheduleTime::getTime(ScheduleDay::getTypeDay($subTeach['day']))[$subTeach['order']-1]['time_start'])?></th>
                                <td><?=Grade::getGradeName($subTeach['grade'])?> / <?=Subject::getShortName_Id($subTeach['subject'])?></td>

                            </tr>
                            <?php endforeach;?>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            <?php endforeach;?></div>
    <?php endif;?>


</div>

