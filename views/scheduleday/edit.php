<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 10.11.2018
 * Time: 13:37
 */
use app\models\ScheduleDay;
use app\models\Grade;
use app\models\Schedule;
use app\models\ScheduleTime;
$this->title = 'История расписания';?>


<div class="container">

    <?php  foreach (ScheduleDay::getDays() as $day): ?>
        <h6><?=date('j.m.Y', $day['day'])?></h6>



        <?php  $number_day = (int)$day['id'];
        $grades = Grade::getGrades();


        $times = ScheduleTime::getTime_start($number_day);
        //var_dump(getLessons($number_day));exit();
        $lessons = Schedule::getLessons($number_day);
        $lessons_id = Schedule::getLessons_id($number_day);
        $time=ScheduleDay::getSchedule_dayInTable($number_day);
        //var_dump($time);exit();

        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered schedule">
                            <thead>
                            <tr>

                                <th><i class="fa fa-clock-o"></i></th>
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
                                    <?= $order[$grade['id']] ?>
                                   <!-- <?php /*if($day>=$time_now):*/?>
                                        <div class="schedule__update_lessons">
                                            <a href="updateSchedule.php?id=<?/*= $order_id[$grade['id']]*/?>"
                                               class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i>
                                            </a>
                                            <a href="deleteSchedule.php?id=<?/*= $order_id[$grade['id']]*/?>"
                                               class="btn btn-sm btn-outline-danger delete"><i class="fa fa-trash-o"></i>
                                            </a>
                                        </div>
                                    --><?php /*endif;*/?>
                                    <?php
                                else: ?>
                                    <?php /*if($day>=$time_now):*/?><!--
                                        <a  href="addSchedule.php?grade=<?/*=$grade['id']*/?>&order=<?/*=$i*/?>&day=<?/*=$number_day*/?>" title="добавить">
                                            <div class="change">
                                                <i class="fa fa-plus fa-lg" aria-hidden="true"></i>
                                            </div>
                                        </a>
                                    --><?php /*endif; */?>
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
    <?php endforeach;?>
</div>