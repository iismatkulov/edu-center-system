<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\FuturePaymentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Оплаты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="future-payment-index">
    <div class="row">
        <div class="col-md-5">
            <h1 style="margin-top: 0;"><?= Html::encode($this->title) ?></h1>


        </div>
        <div class="col-md-7">
            <?=$message?>
        </div>

    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <table class="table table-stripped table-bordered detail-view">
        <tr>
            <th>День оплаты</th>
            <th>Студент</th>
            <th>Номер телефона</th>
            <th>-</th>
            <th>-</th>
            <th>-</th>
            <th>-</th>
            <th>Сумма</th>
            <th>Пользователь</th>
            <th>Статус</th>
            <th></th>
        </tr>
        <?php foreach ($model as $item) : ?>
            <tr>
                <td><?=date('M d Y',$item->pay_date)?></td>
                <td><?=$item->student->fullName?></td>
                <td><?=$item->student->main_phone_number?></td>
                <td>
                    <?php

                    $string=$item->student->main_phone_number;

                    $string = str_replace('(','',$string);
                    $string = str_replace(')','',$string);
                    $string = str_replace('+','',$string);
                    $string = str_replace(' ','',$string);
                    $string = str_replace('-','',$string);
                    $string=trim($string);

                    echo $string;
                    ?>
                </td>
                <td>
                    <?php   echo strlen($string)  ?>
                </td>
                <td>
                    <?php
                        $count_string=strlen($string);
                        if($count_string==9){ echo '998'.$string;  $finished_number='998'.$string; }
                        if($count_string==12){ echo $string; $finished_number=$string; }
                        if($count_string>=13||$count_string<9||$count_string==10){ echo '-------'; }
                    ?>
                </td>
                <td>
                    <?= Yii::$app->playmobile->sendSms($finished_number,$message)?>
                </td>
                <td><?=number_format($item->summa)?></td>
                <td><?=$item->user->username?></td>
                <td>
                    <?php if($item->status == 0) : ?>
                        <span style="background: #26B99A;padding:3px 7px;border-radius: 5px;color: #fff"><?=$item->stat_array[$item->status]?></span>
                    <?php else:?>
                        <span style="background: #d9534f;padding:3px 7px;border-radius: 5px;color: #fff"><?=$item->stat_array[$item->status]?></span>
                    <?PHP endif;?>
                </td>
                <td>

                </td>
            </tr>
        <?php endforeach;?>
    </table>
</div>
