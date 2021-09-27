<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Course */

$this->title = 'Курс по предмету: '.$model->subject->name;
$this->params['breadcrumbs'][] = ['label' => 'Курсы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="course-view">
    <div class="row">
        <div class="col-md-8">
            <h1 style="margin-top: 0;"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-4 text-right">
            <p>
                <?Php if($model->status == 0) : ?>
                    <?= Html::a('Изменить статус', ['status', 'status' => 1, 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?php else: ?>
                    <?= Html::a('Изменить статус', ['status', 'status' => 0, 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?php endif;?>
                <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Вы действительно хотите удалить?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            [
                'attribute' => 'subject_id',
                'value' => $model->subject->name,
            ],
            [
                'attribute' => 'subject_id',
                'value' => $model->teacher->fullname,
            ],

            'lang',
//            'teacher_name',
            'start_time',
            [
                'attribute' => 'summa',
                'value' => number_format($model->summa),
            ],
            [
                'attribute' => 'status',
                'value' => $model->stat_array[$model->status]
            ]
        ],
    ]) ?>

</div>
