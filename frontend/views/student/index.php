<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Список студентов';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="student-index">
    <div class="row">
        <div class="col-md-6">
            <h1 style="margin-top: 0;"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-4">
            <?php $form = ActiveForm::begin(['method' => 'POST']); ?>
            <div class="row">
                <div class="col-md-7">
                    <input class="form-control" name="search" type="text" placeholder="Поиск по студентам...">
                </div>
                <div class="col-md-5">
                    <div class="col-md-8">
                        <?= Html::submitButton('Подтвердить', ['class' => 'btn btn-success']) ?>
                    </div>
                    <div class="col-md-4">
                        <?= Html::a('<i class="fa fa-refresh"></i>', ['index'], ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>

            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'user_id',
            'last_name',
            'first_name',
            'middle_name',
            //'address',
            //'birth_date',
            //'main_phone_number',
            //'study_place',
            //'mother_fullname',
            //'mother_phone_number',
            //'father_fullname',
            //'father_phone_number',
            //'created_at',
            //'updated_at',
            [
                'attribute' => 'payment',
                'label' => 'Сумма оплаты',
                'value' => function($data){
                    if(!empty($data->payment->summa)){
                        return number_format($data->payment->summa);
                    }else{
                        return 'Не задано';
                    }
                }
            ],
            [
                'attribute' => 'payment_day',
                'label' => 'Дата след. оплаты',
                'value' => function($data){
                    if($data->payment->pay_date != 0){
                        return date('d-m-Y', $data->payment->pay_date);
                    }else{
                        return 'Не задано';
                    }
                }
            ],
            [
                'attribute' => 'status',
                'value' => function($data){
                    return $data->stat_array[$data->status];

                }
            ],

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', \yii\helpers\Url::to(['delete','id' => $model->id,'page' => Yii::$app->request->get('page')]), [
                            'title' => Yii::t('app', 'lead-delete'),
                        ]);
                    }
                ]
                ],
        ],
    ]); ?>


</div>

