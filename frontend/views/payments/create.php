<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FuturePayment */

$this->title = 'Create Future Payment';
$this->params['breadcrumbs'][] = ['label' => 'Future Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="future-payment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
