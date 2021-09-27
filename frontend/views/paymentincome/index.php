<?php

use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\PaymentIncomeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Приходы';
$this->params['breadcrumbs'][] = $this->title;
$data1 = ArrayHelper::map(\common\models\Student::find()->all(), 'id', 'fullName');

?>
<div class="payment-income-index">
    <div class="row">
        <div class="col-md-10">
            <h1 style="margin-top: 0;"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-2">
            <p>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Добавить приход
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
//            'summa',
            'created:date',
            [
                'attribute' => 'student_id',
                'value' => function($data){
                    return $data->student->fullName;
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
            //'student_id',
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
                    <option selected="">Выберите курс</option>
                    <?php $category = \common\models\Course::find()->all(); foreach ($category as $categ): ?>
                        <option value="<?=$categ->id?>"><?=$categ->subject->name?>(<?=$categ->subject->type->name?>) - <?=$categ->teacher->fullname?>(<?=$categ->start_time?>, <?=number_format($categ->summa)?>)</option>
                    <?php endforeach; ?>
                </select>
                <br>
                <?php
                echo $form->field($model, 'student_id')->widget(DepDrop::classname(), [
                    'options'=>['id'=>'subcat-id','placeholder'=>'Выберите студента'],
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