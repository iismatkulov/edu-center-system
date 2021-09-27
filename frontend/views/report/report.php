<?php

$this->title = 'Отчёт по отправкам';

use dosamigos\datepicker\DateRangePicker;
$date = date('d-m-Y');
$date = strtotime($date);
$tomorrow = $date + 86400;
$summa = 0;
$summa_beznal = 0;
$array = [];
foreach ($model as $item){
    array_push($array,$item->count);
}
$sum = array_sum($array);
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

<div class="row print text-center">
    <?php if(Yii::$app->request->post()) : ?>
        <?Php if(!empty($model)) : ?>
            <div id="printableArea">
                <h2>Отправлено:</h2>
                <h1 style="font-size: 60px" class="badge badge-primary"><?=$sum?></h1>
                <h3>сообщений</h3>
            </div>
        <?php else: ?>

        <?php endif;?>
    <?php else: ?>
        <div class="row text-center">
            <h3>Выберите даты для создания отчета!</h3>
        </div>
    <?Php endif; ?>
</div>