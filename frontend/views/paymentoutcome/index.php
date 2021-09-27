<?php

use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\PaymentOutcomeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список расходов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-outcome-index">
    <div class="row">
        <div class="col-md-10">
            <h1 style="margin-top: 0;"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-2">
            <p>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Добавить расходы
                </button>
            </p>
        </div>
    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'created:date',
            [
                'attribute' => 'outlay_item',
                'value' => function($data){
                    return $data->outlay->name;
                }
            ],
            [
                'attribute' => 'payment_method',
                'value' => function($data){
                    return $data->method[$data->payment_method];
                }
            ],

            [
                'attribute' => 'summa',
                'value' => function($data){
                    return number_format($data->summa);
                }
            ],

            [
                'attribute' => 'user_id',
                'value' => function($data){
                    return $data->user->username;
                }
            ],
            'content:ntext',
            //'status',

            ['class' => 'yii\grid\ActionColumn','template' => ''],
        ],
    ]); ?>


</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php $form = ActiveForm::begin(); ?>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавить приход</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <select class="form-control" id="cat-id" required name="place" >
                    <option selected="">Выберите категорию расхода</option>
                    <?php $category = \common\models\OutlayCategory::find()->all(); foreach ($category as $categ): ?>
                        <option value="<?=$categ->id?>"><?=$categ->name?></option>
                    <?php endforeach; ?>
                </select>
                <br>
                <?php
                echo $form->field($model, 'outlay_item')->widget(DepDrop::classname(), [
                    'options'=>['id'=>'subcat-id','placeholder'=>'Выберите расход'],
                    'pluginOptions'=>[
                        'depends'=>['cat-id'],
                        'placeholder'=>'',
                        'url'=>\yii\helpers\Url::to(['subcat'])
                    ]
                ])->label(false);

                ?>


                <?= $form->field($model, 'payment_method')->radioList($model->method) ?>

                <?= $form->field($model, 'summa')->textInput() ?>

                <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>