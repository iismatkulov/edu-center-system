<?php

use dosamigos\datepicker\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Student */
$cList = \common\models\Course::find()->where(['status' => 0])->all();
$this->title = $model->fullName;
$this->params['breadcrumbs'][] = ['label' => 'Список студентов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$sum = 0;
?>
<div class="student-view">
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
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h5><b>Студент</b></h5>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'first_name',
                    'last_name',
                    'middle_name',
                    'address',
                    'birth_date:date',
                    'main_phone_number',
                    'study_place',
                    [
                        'attribute' => 'created_at',
                        'value' => date('M d Y H:i',$model->created_at)
                    ],
                    [
                        'attribute' => 'updated_at',
                        'value' => date('M d Y H:i',$model->updated_at)
                    ],
                    [
                        'attribute' => 'status',
                        'value' => $model->stat_array[$model->status]
                    ]
                ],
            ]) ?>
            <h5><b>Родители</b></h5>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'father_fullname',
                    'father_phone_number',
                ],
            ]) ?>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'mother_fullname',
                    'mother_phone_number',
                ],
            ]) ?>

        </div>
        <div class="col-md-6">
            <h4>Добавить в курс</h4>
            <?php $form = ActiveForm::begin(); ?>
            <div class="row">
                <div class="col-md-9">
                    <select id="studentcourses-course_id" class="form-control" name="StudentCourses[course_id]" aria-required="true">
                        <option value="">Выберите курс</option>
                        <?php foreach ($cList as $item) : ?>
                        <option value="<?=$item->id?>"><?=$item->subject->name?>(<?=$item->subject->type->name?>) - <?=$item->teacher->fullname?>(<?=$item->start_time?>)</option>
                        <?php endforeach;?>
                    </select>                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-success">Добавить</button>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
            <h4>Список курсов студента</h4>
            <table class="table table-bordered table-striped detail-view">
                <tr>
                    <th>Название</th>
                    <th>Учитель</th>
                    <th>Время начала</th>
                    <th>Цена</th>
                    <th>Действия</th>
                </tr>

                <?php $i = 0; foreach ($all as $item) : ?>
                <?php $i++ ?>
                    <tr>
                        <td><?=$item->course->subject->name?></td>
                        <td><?=$item->course->teacher->fullname?></td>
                        <td><?=$item->course->start_time?></td>
                        <td><?=number_format($item->course->summa)?></td>
                        <td><a href="<?=\yii\helpers\Url::to(['student/coursedelete','id' => $item->id,'student' => $model->id])?>" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                        <?php $sum += $item->course->summa?>
                    </tr>
                <?php endforeach;?>
                <tr>
                    <th colspan="3">Общая сумма:</th>
                    <td><?=number_format($sum)?></td>
                </tr>
            </table>
            <div class="row">
                <div class="col-md-8">
                    <?php if(!empty($payday)) : ?>
                        <h4>- День оплаты: <?=date('d-m-Y',$payday->pay_date)?> - <?=number_format($payday->summa)?> -</h4>
                    <?php else: ?>
                        <h4>- День оплаты: Не назначено -</h4>
                    <?php endif;?>
                </div>
                <div class="col-md-4 text-right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?=$i?>">
                        День оплаты
                    </button>

                </div>
            </div>

            <hr>
            <div class="row">
                <div class="col-md-9">
                    <h4>Список оплат студента</h4>
                </div>
                <div class="col-md-3">
                    <?= Html::a('Подробнее', ['payments', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <table class="table table-bordered table-striped detail-view">
                <tr>
                    <th>Дата</th>
                    <th>Сумма</th>
                </tr>

                <?php foreach ($pay as $item) : ?>
                    <tr>
                        <td><?=date('d-m-Y, H:i:s',$item->created)?></td>
                        <td><?=number_format($item->summa)?></td>
                    </tr>
                <?php endforeach;?>
            </table>
        </div>
    </div>


</div>
<div class="modal fade" id="exampleModal<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавить день оплаты</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php $form = ActiveForm::begin(['action' => \yii\helpers\Url::to(['student/pay','id' => $model->id])]) ?>
            <div class="modal-body">
                <input type="hidden" name="course_pay" value="1">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>День оплаты</label>
                        <input type="text" class="form-control" name="course_payday" value="<?=date('d')?>" placeholder="Введите день оплаты">
                    </div>
                    <div class="col-md-12 form-group">
                        <label>Сумма оплаты</label>
                        <input type="text" class="form-control" name="course_summa" value="<?=$sum?>" placeholder="Введите сумму оплаты">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>
