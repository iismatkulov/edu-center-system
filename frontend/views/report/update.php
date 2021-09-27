<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SmsReport */

$this->title = 'Update Sms Report: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sms Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sms-report-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
