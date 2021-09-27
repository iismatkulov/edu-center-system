<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yiister\gentelella\assets\Asset;
use common\widgets\Alert;

Asset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="nav-<?= !empty($_COOKIE['menuIsCollapsed']) && $_COOKIE['menuIsCollapsed'] == 'true' ? 'sm' : 'md' ?>">
<?php $this->beginBody(); ?>
<div class="container body">

    <div class="main_container">

        <div class="col-md-3 left_col">

            <div class="left_col scroll-view">

                <div class="navbar nav_title" style="border: 0;">
                    <a href="<?= Yii::$app->homeUrl ?>" class="site_title" style="font-size: 20px !important;"><img
                                style="width: 55px;object-fit: cover"
                                src="<?= Yii::$app->request->baseUrl . '/' ?>logo.png"><span><?= Yii::$app->name ?></span></a>
                </div>
                <div class="clearfix"></div>


                <br/>

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                    <div class="menu_section">
                        <h3>Меню</h3>
                        <?=
                        \yiister\gentelella\widgets\Menu::widget(
                            [
                                "items" => [
                                    ["label" => "Главная", "url" => Yii::$app->homeUrl, "icon" => "home"],
                                    ["label" => "Курсы", "url" => \yii\helpers\Url::to(['course/index']), "icon" => "files-o"],
                                    [
                                        "label" => "Студенты",
                                        "icon" => "users",
                                        "url" => "#",
                                        "items" => [
                                            ["label" => "Список студентов", "url" => \yii\helpers\Url::to(['student/index'])],

                                            ["label" => "Зарегистрировать студента", "url" => \yii\helpers\Url::to(['student/register'])],

                                        ],
                                    ],
                                    [
                                        "label" => "Оплаты",
                                        "icon" => "bank",
                                        "url" => "#",
                                        "items" => [
                                            ["label" => "Полные оплаты", "url" => \yii\helpers\Url::to(['payments/index'])],
                                            ["label" => "Частичные оплаты", "url" => \yii\helpers\Url::to(['payments/part'])],

                                            ["label" => "Долги", "url" => \yii\helpers\Url::to(['payments/indexdolg'])],

                                        ],
                                    ],

                                    [
                                        "label" => "Касса",
                                        "icon" => "money",
                                        "url" => "#",
                                        "items" => [
                                            ["label" => "Приходы", "url" => \yii\helpers\Url::to(['paymentincome/index'])],
                                            ["label" => "Отчёты по приходам", "url" => \yii\helpers\Url::to(['paymentincome/report'])],
                                            ["label" => "Расходы", "url" => \yii\helpers\Url::to(['paymentoutcome/index'])],
                                            ["label" => "Отчёты по расходам", "url" => \yii\helpers\Url::to(['paymentoutcome/report'])],
                                        ],
                                    ],
                                    [
                                        "label" => "СМС-отправки",
                                        "icon" => "envelope-o",
                                        "url" => "#",
                                        "items" => [
                                            ["label" => "История", "url" => \yii\helpers\Url::to(['report/index'])],
                                            ["label" => "Отчёт по СМС", "url" => \yii\helpers\Url::to(['report/report'])],
                                        ],
                                    ],

//                                    [
//                                        "label" => "Не трогать",
//                                        "icon" => "money",
//                                        "url" => "#",
//                                        "items" => [
//                                           ["label" => "Сегодня", "url" => \yii\helpers\Url::to(['message/today'])],
//                                            ["label" => "Завтра", "url" => \yii\helpers\Url::to(['message/tomorrow'])],
//                                            ["label" => "2 дня", "url" => \yii\helpers\Url::to(['message/day'])],
//                                            ["label" => "Просроченные", "url" => \yii\helpers\Url::to(['message/dolg'])],
//                                           ["label" => "Долги", "url" => \yii\helpers\Url::to(['message/indexdolg'])],
//                                        ],
//                                   ],
                                ],
                            ]
                        )
                        ?>
                    </div>

                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                
                <!-- /menu footer buttons -->
            </div>
        </div>
        

        <!-- top navigation -->
        <div class="top_nav">

            <div class="nav_menu">
                <nav class="" role="navigation">
                    
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    
                    <ul class="nav navbar-nav navbar-right">
                        
                        
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                                   aria-expanded="false">
                                    <img src="<?= Yii::$app->request->baseUrl . '/' ?>user.png" alt=""> <?=Yii::$app->user->identity->username?>
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu pull-right">
                                
                                    <li>
                                        <a href="<?=\yii\helpers\Url::to(['site/logout'])?>">Выйти (<?=Yii::$app->user->identity->username?>)</a>
                                    </li>
                                </ul>
                            </li>
                    </ul>
                </nav>
            </div>

        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <?php if (isset($this->params['h1'])): ?>
                <div class="page-title">
                    <div class="title_left">
                        <h1><?= $this->params['h1'] ?></h1>
                    </div>
                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">Go!</button>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="clearfix"></div>

            <?= $content ?>
        </div>
        <!-- /page content -->
        <!-- footer content -->
        <footer>
            <div class="pull-right">
                <?= Yii::powered() ?>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>

</div>

<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div>
<!-- /footer content -->
<?php $this->endBody(); ?>
</body>
<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
</html>
<?php $this->endPage() ?>
