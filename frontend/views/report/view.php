<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SmsReport */

$this->title = 'Отчёт смс-отправок за: '.date('d.m.Y H:i:s',$model->created).' для метода '.$model->arr[$model->method];
$this->params['breadcrumbs'][] = ['label' => 'СМС-лог', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sms-report-view">

    <h3>Отчёт смс-отправок за: <span class="badge badge-primary"><?=date('d.m.Y H:i:s',$model->created)?></span> для метода <span class="badge badge-success"><?=$model->arr[$model->method]?></span></h3>

    <?= \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            'created:datetime',
            'phone',
            'message',
        ],
    ]) ?>

</div>
