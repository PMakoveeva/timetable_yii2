<?php
use yii\grid\GridView;
/* @var $this yii\web\View */
use app\models\Schedule;
use app\models\Subject;
use yii\helpers\Html;
use app\models\ScheduleTime;
use app\models\Room;
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;
use app\models\ScheduleLessonForm;
use yii\bootstrap\Button;
use yii\helpers\Url;

$this->title = 'Изменения в расписании на ' . $date ." ". $dayName ;

?>
<div class="site-index">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered schedule">
                    <thead>
                    <tr class="text-center">
                        <th><i class="glyphicon glyphicon-calendar"></i></th>
                        <?php foreach ($grades as $grade): ?>
                            <th scope="col"><?= $grade['name'] ?></th>
                        <?php endforeach; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    for ($i = 1; $i <= 12; $i++) :
                        if (isset($lessons_id[$i])) $order_id = $lessons_id[$i];
                        else $order_id = [];
                        if (isset($lessons[$i])) $order = $lessons[$i];
                        else $order = [];
                        $time = isset($time_start[$i - 1]['time_start']) ? ScheduleTime::intToTime($time_start[$i - 1]['time_start'], true) : ['h' => '', 'm' => ''];
                        ?>
                        <th><?= $time['h'] ?><sup><?= $time['m'] ?></sup></th>

                        <?php foreach ($grades as $grade): ?>
                        <td><?php

                        if (isset($order[$grade['id']])): ?>
                            <?php $room = Room::getNameRoom(Schedule::getRoom($order_id[$grade['id']]));
                             if($room == ''){
                                 $subjectR = Schedule::find()->where(['id' => $order_id[$grade['id']]])->one()->subject;
                                 $teacherR = Subject::getTeacher($subjectR);
                                 if(Room::find()->where(['teacher' => $teacherR])->one()){
                                     $room = Room::find()->where(['teacher' => $teacherR])->one()->name;
                                     $roomId = Room::find()->where(['teacher' => $teacherR])->one()->id;
                                     $less = \app\models\ScheduleLessonForm::find()->where(['id' => $order_id[$grade['id']]])->one();
                                     $less -> room = $roomId;
                                 }
                                 else{
                                     $roomId = Room::GetEmptyRoom($day, $order);
                                     $room = Room::getNameRoom($roomId);
                                     $less = \app\models\ScheduleLessonForm::find()-> where(['id' => $order_id[$grade['id']]])->one();
                                     $less -> room = $roomId;

                                 }
                             }
                            if(Schedule::getFirstOrderForGrade($grade['id'], $order_id[$grade['id']]))

                                $teacher=Subject::getTeacher(Subject::getIdSub_ShortName($order[$grade['id']]));
                            echo $order[$grade['id']] ?><sup><sup><?=$room;?></sup></sup>
                            <?php
                            if($day>=$time_now && !Yii::$app->user->isGuest):?>
                                <div class="schedule__update_lessons">
                                    <?= Html::a(
                                        '<i class="glyphicon glyphicon-pencil"></i>',
                                        \yii\helpers\Url::to(['site/updatelesson', 'id'=>$order_id[$grade['id']]]))
                                    ?>
                                    <?= Html::a(
                                        '<i class="glyphicon glyphicon-trash"></i>',
                                        \yii\helpers\Url::to(['site/deletelesson', 'id'=>$order_id[$grade['id']]]))?>
                                </div>
                            <?php endif;?>
                            <?php
                        else: ?>
                            <?php
                            if(($day>=$time_now) && (!Yii::$app->user->isGuest)):?>
                                <div class="change">
                                <?= Html::a(
                                    '<i class="glyphicon glyphicon-plus"></i>',
                                    \yii\helpers\Url::to(['site/addlesson', 'grade' => $grade['id'], 'order' => $i, 'day' => $number_day], ['class' => 'change']))?>
                                </div>
                            <?php endif;?>
                        <?php endif;?>
                    <?php endforeach ?>
                        </td>
                        </tr>
                    <?php endfor ?>


                    </tbody>
                </table>
                <?php if(($day>=$time_now) && (!Yii::$app->user->isGuest)):?>
                    <?=
                    Html::a(
                        'Копировать данные с предыдушего дня',
                        \yii\helpers\Url::to(['site/copy','idDay' => $number_day,], ['class' => 'btn btn-success']));
                    ?>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>


</div>
