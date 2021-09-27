<?php

$this->title = 'Отчёт по приходам';

use dosamigos\datepicker\DateRangePicker;
$date = date('d-m-Y');
$date = strtotime($date);
$tomorrow = $date + 86400;
$summa = 0;
$summa_beznal = 0;
?>
<style>
    @media print {
        .noPrint{
            display:none !important;
            visibility: hidden !important;
        }
    }
</style>
<div class="row">
    <div class="col-md-7">
        <h1 style="margin-top: 0;"><?=\yii\helpers\Html::encode($this->title)?></h1>
    </div>
    <div class="col-md-5" style="margin-top: 5px;">
        <div class="row">
            <?php \yii\widgets\ActiveForm::begin() ?>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-5">
                        <input type="date" class="form-control" name="from">
                    </div>
                    <div class="col-md-1">
                        <h4>по</h4>
                    </div>
                    <div class="col-md-5">
                        <input type="date" class="form-control" name="to">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <?=\yii\helpers\Html::submitButton('Подтвердить', ['class' => 'btn btn-success'])?>
            </div>
            <?php \yii\widgets\ActiveForm::end() ?>
        </div>
    </div>
</div>

<div class="row print">
    <?php if(Yii::$app->request->post()) : ?>
        <?Php if(!empty($model)) : ?>
            <div class="row noPrint" style="margin-top: 20px;">
                <div class="col-md-12 text-left">
                    <button type="button" onclick="printDiv('printableArea')" class="btn btn-success noPrint">Печать</button>
                </div>
            </div>
            <div id="printableArea">
                <h4>Отчёт приходов с <?=date('d-m-Y',$from)?> по <?=date('d-m-Y',$to)?></h4>
                <div class="row">
                    <div class="col-md-6">
                        <h3>Наличными</h3>
                        <table class="table table-striped table-bordered" id="printableArea">
                            <tr>
                                <th>Дата создания</th>
                                <th>Студент</th>
                                <th>Пользователь</th>
                                <th>Комментарий</th>

                                <th>Сумма</th>
                            </tr>
                            <?php foreach ($model as $item) : ?>
                                <tr>
                                    <td><?=date('d-m-Y, H:i',$item->created)?></td>
                                    <td><?=$item->student->fullName?></td>
                                    <td><?=$item->user->username?></td>
                                    <td><?=$item->content?></td>

                                    <td><?=number_format($item->summa)?></td>
                                </tr>
                                <?php $summa += $item->summa?>
                            <?php endforeach;?>
                            <tr>
                                <th colspan="4">Общая сумма:</th>
                                <td><?=number_format($summa)?></td>
                            </tr>

                        </table>
                    </div>
                    <div class="col-md-6">
                        <h3>Переводом</h3>
                        <table class="table table-striped table-bordered" id="printableArea">
                            <tr>
                                <th>Дата создания</th>
                                <th>Студент</th>
                                <th>Пользователь</th>
                                <th>Комментарий</th>

                                <th>Сумма</th>
                            </tr>
                            <?php foreach ($model1 as $item) : ?>
                                <tr>
                                    <td><?=date('d-m-Y, H:i',$item->created)?></td>
                                    <td><?=$item->student->fullName?></td>
                                    <td><?=$item->user->username?></td>
                                    <td><?=$item->content?></td>

                                    <td><?=number_format($item->summa)?></td>
                                </tr>
                                <?php $summa_beznal += $item->summa?>
                            <?php endforeach;?>
                            <tr>
                                <th colspan="4">Общая сумма:</th>
                                <td><?=number_format($summa_beznal)?></td>
                            </tr>

                        </table>
                    </div>
                </div>


            </div>
        <?php else: ?>
            <table class="table table-striped table-bordered">
                <tr>
                    <th>Дата создания</th>
                    <th>Студент</th>
                    <th>Пользователь</th>
                    <th>Комментарий</th>
                    <th>Метод оплаты</th>
                    <th>Сумма</th>
                </tr>
                <tr style="text-align: center">
                    <th colspan="6" style="text-align: center">
                        Поиск не дал результатов!
                    </th>
                </tr>
            </table>
        <?php endif;?>
    <?php else: ?>
    <div class="row text-center">
        <h3>Выберите даты для создания отчета!</h3>
    </div>
    <?Php endif; ?>
</div>