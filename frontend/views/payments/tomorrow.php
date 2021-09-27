<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\FuturePaymentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Оплаты на завтра';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="future-payment-index">
    <div class="row">
        <div class="col-md-5">
            <h1 style="margin-top: 0;"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-7 text-right">
            <div class="row">
                <div class="col-md-12">
                    <a href="<?=Url::to(['payments/today'])?>" class="btn btn-success">На сегодня</a>
                    <a href="<?=Url::to(['payments/day'])?>" class="btn btn-warning">Через 2 дня</i></a>
                    <a href="<?=Url::to(['payments/dolg'])?>" class="btn btn-danger">Просроченные</i></a>
                    <a href="<?=Url::to(['payments/refresh'])?>" class="btn btn-dark"><i class="fa fa-refresh"></i></a>
                </div>
            </div>
        </div>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <table class="table table-stripped table-bordered detail-view">
        <tr>
            <th>День оплаты</th>
            <th>Студент</th>
            <th>Сумма</th>
            <th>Пользователь</th>
            <th>Статус</th>
            <th></th>
        </tr>
        <?php foreach ($model as $item) : ?>
            <tr>
                <td><?=date('M d Y',$item->pay_date)?></td>
                <td><?=$item->student->fullName?></td>
                <td><?=number_format($item->summa)?></td>
                <td><?=$item->user->username?></td>
                <td>
                    <?php if($item->status == 0) : ?>
                        <span style="background: #26B99A;padding:3px 7px;border-radius: 5px;color: #fff"><?=$item->stat_array[$item->status]?></span>
                    <?php else:?>
                        <span style="background: #d9534f;padding:3px 7px;border-radius: 5px;color: #fff"><?=$item->stat_array[$item->status]?></span>
                    <?PHP endif;?>
                </td>
                <td>

                    <a style="height: 20px;font-size: 12px;padding-top: 2px;" class="btn btn-success" data-toggle="modal" data-target="#<?=$item->id?>"><i class="glyphicon glyphicon-check"></i> Полная оплата</a>
                    <?php if($item->status == 0): ?>
                        <a style="height: 20px;font-size: 12px;padding-top: 2px;" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?=$item->id?>"><i class="fa fa-percent"></i> Частичная оплата</a>
                    <?php else: ?>

                    <?Php endif;?>


                    <div class="modal fade" id="exampleModal<?=$item->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <?php $form = ActiveForm::begin(['action' => Url::to(['payments/pay','id' => $item->id])]); ?>
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Частичная оплата</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <label>Способ оплаты</label>
                                    <div id="paymentincome-payment_method form-group" role="radiogroup" aria-required="true" aria-invalid="false">
                                        <label>
                                            <input type="radio" name="method" value="0"> Наличный
                                        </label>
                                        <label>
                                            <input type="radio" name="method" value="1"> Безналичный
                                        </label>
                                    </div>
                                    <input class="form-control" type="text" name="sum" placeholder="Введите сумму">
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                </div>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="<?=$item->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <?php $form = ActiveForm::begin(['action' => Url::to(['payments/status','id' => $item->id])]); ?>
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Полная оплата</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <label>Способ оплаты</label>
                                    <div id="paymentincome-payment_method" role="radiogroup" aria-required="true" aria-invalid="false">
                                        <label>
                                            <input type="radio" name="method" value="0"> Наличный
                                        </label>
                                        <label>
                                            <input type="radio" name="method" value="1"> Безналичный
                                        </label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                </div>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
</div>
