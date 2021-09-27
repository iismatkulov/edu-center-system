<?php

use dosamigos\datepicker\DatePicker;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Student */

$this->title = 'Изменить данные студента: ' . $model->last_name.' '.$model->first_name.' '.$model->middle_name;
$this->params['breadcrumbs'][] = ['label' => 'Список студентов', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="student-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="student-form">
        <hr>
        <h5><b>Информация о студенте</b></h5>
        <hr>
        <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-3">
                <label>Дата рождения</label>
                <?= DatePicker::widget([
                    'model' => $model,
                    'attribute' => 'birth_date',
                    'template' => '{addon}{input}',
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-M-yyyy'
                    ]
                ]);?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'main_phone_number')->textInput(['maxlength' => true,'id' => 'phoneNumber1']) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'study_place')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <hr>
        <h5><b>Информация о родителях</b></h5>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'father_fullname')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'father_phone_number')->textInput(['maxlength' => true,'id' => 'phoneNumber2']) ?>

            </div>

            <div class="col-md-6">
                <?= $form->field($model, 'mother_fullname')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'mother_phone_number')->textInput(['maxlength' => true,'id' => 'phoneNumber3']) ?>

            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
