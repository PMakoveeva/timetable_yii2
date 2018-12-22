<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <base href="<?= Yii::$app->homeUrl ?>">
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="container wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            /*['label' => 'Home', 'url' => ['/site/index']],*/

            ['label' => 'Учитель',  'items' => [
                ['label' => 'Расписание для учителя', 'url' => ['/teacher/schedule'], 'visible' => Yii::$app->user->isGuest,],
                ['label' => 'Добавить', 'url' => ['/teacher/add'], 'visible' => !Yii::$app->user->isGuest,],
                ['label' => 'Учителя', 'url' => ['/teacher/index'], 'visible' => !Yii::$app->user->isGuest,],

            ]],
            ['label' => 'Классы',  'items' => [
                ['label' => 'Расписание для класса', 'url' => ['/grade/schedule'], 'visible' =>Yii::$app->user->isGuest],
                ['label' => 'Добавить', 'url' => ['/grade/add'], 'visible' => !Yii::$app->user->isGuest,],
                ['label' => 'Все классы', 'url' => ['/grade/index'], 'visible' => !Yii::$app->user->isGuest,],
            ]],

            ['label' => 'Предмет',  'visible' => !Yii::$app->user->isGuest, 'items' => [
                ['label' => 'Добавить', 'url' => ['/subject/add']],
                ['label' => 'Все предметы', 'url' => ['/subject/index']],
            ]],
            ['label' => 'Кабинеты', 'visible' => !Yii::$app->user->isGuest, 'items' => [
                ['label' => 'Добавить', 'url' => ['/room/add']],
                ['label' => 'Все кабинеты', 'url' => ['/room/index']],
            ]],
            ['label' => 'Типы расписания',  'visible' => !Yii::$app->user->isGuest, 'items' => [
                ['label' => 'Добавить', 'url' => ['/schedule/add']],
                ['label' => 'Изменить', 'url' => ['/schedule/index']],
                ]],
            Yii::$app->user->isGuest ? (
            ['label' => 'Вход', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Выход (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <h1><?= $this->title ?></h1>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<!--<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?/*= date('Y') */?></p>

        <p class="pull-right"><?/*= Yii::powered() */?></p>
    </div>
</footer>
-->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
