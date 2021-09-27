<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\SmsReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'СМС-лог';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sms-report-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'created:datetime',
            [
                'attribute' => 'method',
                'value' => function($data){
                    return $data->arr[$data->method];
                }
            ],
            'count',

            ['class' => 'yii\grid\ActionColumn','template' => '{view}'],
        ],
    ]); ?>


</div>
