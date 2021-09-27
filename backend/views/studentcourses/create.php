<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StudentCourses */

$this->title = 'Create Student Courses';
$this->params['breadcrumbs'][] = ['label' => 'Student Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-courses-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
