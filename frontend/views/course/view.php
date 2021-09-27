<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Student */
$this->title = 'Курс по предмету: '.$model->subject->name;
$this->params['breadcrumbs'][] = ['label' => 'Курсы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$sum = 0;
?>
<div class="student-view">
    <h1 style="margin-top: 0;"><?= Html::encode($this->title) ?></h1>
    <table class="table table-striped table-bordered detail-view">
        <tr>
            <th>Язык преподавания</th>
            <td><?=$model->lang?></td>
            <th>Ф.И.О. Учителя</th>
            <td><?=$model->teacher->fullname?></td>
        </tr>
        <tr>
            <th>Время начала</th>
            <td><?=$model->start_time?></td>
            <th>Цена</th>
            <td><?=number_format($model->summa)?></td>
        </tr>
    </table>
    <hr>
    <h3>Список студентов курса</h3>
    <table class="table table-bordered table-striped detail-view">
        <tr>
            <th>#</th>
            <th>Ф.И.О</th>
            <th>Номер телефона</th>
            <th>Время начала</th>
            <th>Действия</th>
        </tr>

        <?php $i = 0;  foreach ($all as $item) : ?>
        <?php $i++; ?>
        <tr>
            <td><?=$i?></td>
            <td><?=$item->student->fullName?></td>
            <td><?=$item->student->main_phone_number?></td>
            <td><?=$item->student->study_place?></td>
            <td>
                <?= Html::a('Оплата', ['paymentincome/index'], ['class' => 'btn btn-success']) ?>
                <?= Html::a('О студенте', ['student/view', 'id' => $item->student->id], ['class' => 'btn btn-primary']) ?>
            </td>
            <?php endforeach;?>
    </table>

</div>
