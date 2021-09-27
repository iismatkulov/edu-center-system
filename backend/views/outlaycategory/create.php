<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\OutlayCategory */

$this->title = 'Create Outlay Category';
$this->params['breadcrumbs'][] = ['label' => 'Outlay Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outlay-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
