<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Course */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="course-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'subject_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Subject::find()->all(),'id','name'),['prompt' => 'Выберите предмет']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'teacher_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Teacher::find()->all(),'id','fullname'),['prompt' => 'Выберите предмет']) ?>
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

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
