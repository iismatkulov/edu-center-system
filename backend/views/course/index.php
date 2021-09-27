<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CourseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Курсы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-index">
    <div class="row">
        <div class="col-md-10">
            <h1 style="margin-top: 0;"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-2 text-right">
            <p>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Добавить курс
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

//            'name',
            [
                'attribute' => 'subject_id',
                'value' => function($data){
                    return $data->subject->name;

                }
            ],
            [
                'attribute' => 'teacher_id',
                'value' => function($data){
                    return $data->teacher->fullname;

                }
            ],


            'lang',
//            'teacher_name',
            'start_time',
            //'summa',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
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
                    <div class="col-md-6">
                        <?= $form->field($model, 'subject_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Subject::find()->all(),'id','name'),['prompt' => 'Выберите предмет']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'teacher_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Teacher::find()->all(),'id','fullname'),['prompt' => 'Выберите учителя']) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field($model, 'lang')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'start_time')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'summa')->textInput() ?>
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