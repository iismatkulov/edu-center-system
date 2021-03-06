<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Teacher */

$this->title = 'Обновить данные учителя: ' . $model->fullname;
$this->params['breadcrumbs'][] = ['label' => 'Список учителей курсов', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="teacher-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
