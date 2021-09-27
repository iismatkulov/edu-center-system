<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm; ?>

    <td><?=date('M d Y',$model->pay_date)?></td>
    <td><?=$model->student->fullName?></td>
    <td><?=number_format($model->summa)?></td>
    <td><?=$model->user->username?></td>
    <td>
        <?php if($model->status == 0) : ?>
            <span style="background: #26B99A;padding:3px 7px;border-radius: 5px;color: #fff"><?=$model->stat_array[$model->status]?></span>
        <?php else:?>
            <span style="background: #d9534f;padding:3px 7px;border-radius: 5px;color: #fff"><?=$model->stat_array[$model->status]?></span>
        <?PHP endif;?>
    </td>
    <td>

        <a style="height: 20px;font-size: 12px;padding-top: 2px;" class="btn btn-success" data-toggle="modal" data-target="#<?=$model->id?>"><i class="glyphicon glyphicon-check"></i> Полная оплата</a>
        <?php if($model->status == 0): ?>
            <a style="height: 20px;font-size: 12px;padding-top: 2px;" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?=$model->id?>"><i class="fa fa-percent"></i> Частичная оплата</a>
            <a style="height: 20px;font-size: 12px;padding-top: 2px;" class="btn btn-danger" data-toggle="modal" data-target="#<?=$model->id?>-dolg"><i class="glyphicon glyphicon-time"></i> Долг</a>

        <?php else: ?>

        <?Php endif;?>
        <?php if($model->status == 1) : ?>
            <a style="height: 20px;font-size: 12px;padding-top: 2px;" class="btn btn-danger" href="<?=Url::to(['payment/sendpart','id' => $model->id])?>"><i class="glyphicon glyphicon-envelope"></i> Отправить сообщение</a>
        <?Php elseif ($model->status == 2):?>
            <a style="height: 20px;font-size: 12px;padding-top: 2px;" class="btn btn-danger" href="<?=Url::to(['payment/senddolg','id' => $model->id])?>"><i class="glyphicon glyphicon-envelope"></i> Отправить сообщение</a>

        <?Php endif;?>
        <a style="height: 20px;font-size: 12px;padding-top: 2px;" class="btn btn-danger" href="<?=Url::to(['payments/delete','id' => $model->id,'page' => Yii::$app->request->get('page')])?>"><i class="glyphicon glyphicon-trash"></i> Удалить оплату</a>

        <div class="modal fade" id="exampleModal<?=$model->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <?php $form = ActiveForm::begin(['action' => Url::to(['payments/pay','id' => $model->id])]); ?>
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
        <div class="modal fade" id="<?=$model->id?>-dolg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <?php $form = ActiveForm::begin(['action' => Url::to(['payments/dolgtime','id' => $model->id])]); ?>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Перенос оплаты</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label>Выберите дату оплаты</label>
                        <input class="form-control" type="date" name="date">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
        <div class="modal fade" id="<?=$model->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <?php $form = ActiveForm::begin(['action' => Url::to(['payments/status','id' => $model->id])]); ?>
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

