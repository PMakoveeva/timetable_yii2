<?php
use yii\grid\GridView;
/* @var $this yii\web\View */
use app\models\Schedule;
use app\models\Subject;
use yii\helpers\Html;
use app\models\ScheduleTime;
use app\models\Room;

$this->title = 'Изменения в расписании на ' . $dayName ." ". $date ;

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

                            <?php $room = '';
                            if(Schedule::getFirstOrderForGrade($grade['id'], $order_id[$grade['id']]))
                                $room = Room::getNameRoom(Schedule::getRoom($order_id[$grade['id']]));
                                $teacher=Subject::getTeacher(Subject::getIdSub_ShortName($order[$grade['id']]));
                                $roomForSchedule = Room::getRoomForSchedule($room, $teacher);
                            echo $order[$grade['id']] ?><sup><sup><?=$roomForSchedule;?></sup></sup>
                            <?php if($date>=$time_now):?>
                                <div class="schedule__update_lessons">
                                    <?php Html::a(
                                        '<i class="glyphicon glyphicon-pencil"></i>',
                                        \yii\helpers\Url::to(['site/update-sub', 'id'=>$order_id[$grade['id']]]))?>
                                    <?php Html::a(
                                        '<i class="glyphicon glyphicon-trash"></i>',
                                        \yii\helpers\Url::to(['site/delete-sub', 'id'=>$order_id[$grade['id']]]))?>
                                </div>
                            <?php endif;?>
                            <?php
                        else: ?>
                            <?php if($date>=$time_now):?>
                                <div class="change">
                                <?php Html::a(
                                    '<i class="glyphicon glyphicon-plus"></i>',
                                    \yii\helpers\Url::to(['site/add-sub', 'grade' => $grade['id'], 'order' => $i, 'day' => $number_day]))?>
                                    </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach ?>
                        </td>
                        </tr>
                    <?php endfor ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


</div>
