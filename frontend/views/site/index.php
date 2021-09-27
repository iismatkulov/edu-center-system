<?php

/* @var $this yii\web\View */
$this->title = 'GLC MANAGER';
$income = \common\models\PaymentIncome::find()->where(['payment_method' => 0])->andWhere(['between', 'created', strtotime(date('d-m-Y')),strtotime(date('d-m-Y')) + 86399])->sum('summa');
$bez_income = \common\models\PaymentIncome::find()->where(['payment_method' => 1])->andWhere(['between', 'created', strtotime(date('d-m-Y')),strtotime(date('d-m-Y')) + 86399])->sum('summa');
$outcome = \common\models\PaymentOutcome::find()->where(['payment_method' => 0])->andWhere(['between', 'created', strtotime(date('d-m-Y')),strtotime(date('d-m-Y')) + 86399])->sum('summa');
$bez_outcome = \common\models\PaymentOutcome::find()->where(['payment_method' => 1])->andWhere(['between', 'created', strtotime(date('d-m-Y')),strtotime(date('d-m-Y')) + 86399])->sum('summa');
?>
<div class="row">
    <div class="col-md-6">
        <table class="table table-bordered table-striped">
            <tr style="background: #26B99A;color: #fff">
                <th colspan="2" class="text-center">
                    Приходы за сегодня
                </th>
            </tr>
            <tr>
                <th>Наличные</th>
                <td><?=number_format($income)?></td>
            </tr>
            <tr>
                <th>Безналичные</th>
                <td><?=number_format($bez_income)?></td>
            </tr>
            <tr>
                <th>Общая сумма: </th>
                <td><?=number_format($bez_income + $income)?></td>
            </tr>
        </table>
    </div>
    <div class="col-md-6">
        <table class="table table-bordered table-striped">
            <tr>
                <th colspan="2" style="background:#d9534f;color: #fff" class="text-center">
                    Расходы за сегодня
                </th>
            </tr>
            <tr>
                <th>Наличные</th>
                <td><?=number_format($outcome)?></td>
            </tr>
            <tr>
                <th>Безналичные</th>
                <td><?=number_format($bez_outcome)?></td>
            </tr>
            <tr>
                <th>Общая сумма: </th>
                <td><?=number_format($bez_outcome + $outcome)?></td>
            </tr>
        </table>
    </div>
</div>
