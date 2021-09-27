<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\FuturePaymentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Оплаты через 2 дня';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="future-payment-index">
    <div class="row">
        <div class="col-md-5">
            <h1 style="margin-top: 0;"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-7 text-right">
            <div class="row">
                <div class="col-md-12">
                    <a href="<?=Url::to(['payments/today'])?>" class="btn btn-success">На сегодня</a>
                    <a href="<?=Url::to(['payments/tomorrow'])?>" class="btn btn-primary">На завтра</a>
                    <a href="<?=Url::to(['payments/dolg'])?>" class="btn btn-danger">Просроченные</i></a>
                    <a href="<?=Url::to(['payments/refresh'])?>" class="btn btn-dark"><i class="fa fa-refresh"></i></a>
                </div>
            </div>
        </div>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <table class="table table-stripped table-bordered detail-view">
        <tr>
            <th>День оплаты</th>
            <th>Студент</th>
            <th>Сумма</th>
            <th>Пользователь</th>
            <th>Статус</th>
            <th></th>
        </tr>
        <?php echo ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_item',
            'summary' => '',

            'itemOptions' => [
                'tag' => 'tr'
            ],
            'pager' => [
                'options' => [
                    'class' => 'pagination',
                ],
            ],
        ]);?>
    </table>
</div>
