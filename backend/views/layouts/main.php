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
//                                    ["label" => "Error page", "url" => ["site/error"], "icon" => "close"],
                                        [
                                            "label" => "Курсы",
                                            "icon" => "book",
                                            "url" => "#",
                                            "items" => [
                                                ['label' => 'Типы предметов', 'url' => ['/coursetype/index']],
                                                ['label' => 'Предметы', 'url' => ['/subject/index']],
                                                ['label' => 'Учителя', 'url' => ['/teacher/index']],
                                                ['label' => 'Список курсов', 'url' => ['/course/index']],
                                            ],
                                        ],
                                        ["label" => "Категории расходов", "url" => \yii\helpers\Url::to(['outlaycategory/index']), "icon" => "money"],

//                                    [
//                                        "label" => "Badges",
//                                        "url" => "#",
//                                        "icon" => "table",
//                                        "items" => [
//                                            [
//                                                "label" => "Default",
//                                                "url" => "#",
//                                                "badge" => "123",
//                                            ],
//                                            [
//                                                "label" => "Success",
//                                                "url" => "#",
//                                                "badge" => "new",
//                                                "badgeOptions" => ["class" => "label-success"],
//                                            ],
//                                            [
//                                                "label" => "Danger",
//                                                "url" => "#",
//                                                "badge" => "!",
//                                                "badgeOptions" => ["class" => "label-danger"],
//                                            ],
//                                        ],
//                                    ],
//                                    [
//                                        "label" => "Multilevel",
//                                        "url" => "#",
//                                        "icon" => "table",
//                                        "items" => [
//                                            [
//                                                "label" => "Second level 1",
//                                                "url" => "#",
//                                            ],
//                                            [
//                                                "label" => "Second level 2",
//                                                "url" => "#",
//                                                "items" => [
//                                                    [
//                                                        "label" => "Third level 1",
//                                                        "url" => "#",
//                                                    ],
//                                                    [
//                                                        "label" => "Third level 2",
//                                                        "url" => "#",
//                                                    ],
//                                                ],
//                                            ],
//                                        ],
//                                    ],
                                    ],
                                ]
                            )
                            ?>
                        </div>

                    </div>
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
                                    <img src="https://w7.pngwing.com/pngs/764/495/png-transparent-computer-icons-user-profile-user-miscellaneous-silhouette-account.png" alt=""> <?=Yii::$app->user->identity->username?>
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu pull-right">
                                    
                                    <li>
                                        <a href="<?=\yii\helpers\Url::to(['user/changepassword'])?>">Изменить пароль</a>
                                    </li>
                                    <li>
                                        <a href="<?=\yii\helpers\Url::to(['site/logout'])?>">Выйти (<?=Yii::$app->user->identity->username?>)</a>
                                    </li>
                                </ul>
                            </li>
                        <li role="presentation" class="dropdown">
                            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                <li>
                                    <a>
                                        <span class="image">
                                            <img src="http://placehold.it/128x128" alt="Profile Image"/>
                                        </span>
                                        <span>
                                            <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                        </span>
                                        <span class="message">
                                            Film festivals used to be do-or-die moments for movie makers. They were where...
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image">
                                            <img src="http://placehold.it/128x128" alt="Profile Image"/>
                                        </span>
                                        <span>
                                            <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                        </span>
                                        <span class="message">
                                            Film festivals used to be do-or-die moments for movie makers. They were where...
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image">
                                            <img src="http://placehold.it/128x128" alt="Profile Image"/>
                                        </span>
                                        <span>
                                            <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                        </span>
                                        <span class="message">
                                            Film festivals used to be do-or-die moments for movie makers. They were where...
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image">
                                            <img src="http://placehold.it/128x128" alt="Profile Image"/>
                                        </span>
                                        <span>
                                            <span>John Smith</span>
                                        <span class="time">3 mins ago</span>
                                        </span>
                                        <span class="message">
                                            Film festivals used to be do-or-die moments for movie makers. They were where...
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <div class="text-center">
                                        <a href="/">
                                            <strong>See All Alerts</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
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

</html>
<?php $this->endPage() ?>
