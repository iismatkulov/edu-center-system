<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CourseType */

$this->title = 'Update Course Type: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Course Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="course-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
