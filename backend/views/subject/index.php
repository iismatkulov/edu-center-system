<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\SubjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Предметы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subject-index">
    <div class="row">
        <div class="col-md-10">
            <h1 style="margin-top: 0;"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-2">
            <p>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Добавить предмет
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
//            'type_id',
            [
                'attribute' => 'type_id',
                'value' => function($data){
                    return $data->type->name;
                }
            ],
            'name',

            ['class' => 'yii\grid\ActionColumn','template' => '{update} {delete}'],
        ],
    ]); ?>


</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <?php $form = ActiveForm::begin(); ?>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавить курс</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-12">
                        <?= $form->field($model, 'type_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\CourseType::find()->all(),'id','name'),['prompt' => 'Выберите тип']) ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>