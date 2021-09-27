<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Изменить пароль';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pass'] = 'active opened active';
?>
<div class="row">
    <div class="col-md-12 mb-5">
        <h1><?=Html::decode($this->title)?></h1>
    </div>
    <div class="col-md-12">
        <?php $form = ActiveForm::begin([
            'id'=>'changepassword-form',
            'options'=>['class'=>'form-horizontal'],
            'fieldConfig'=>[
                'template'=>"{label}\n<div class=\"col-lg-5\">
                                                {input}</div>\n<div class=\"col-lg-5\">
                                                {error}</div>",
                'labelOptions'=>['class'=>'col-lg-2 control-label'],
            ],
        ]); ?>
        <?= $form->field($model,'oldpass',['inputOptions'=>[
            'placeholder'=>'Введите старый пароль'
        ]])->passwordInput() ?>

        <?= $form->field($model,'newpass',['inputOptions'=>[
            'placeholder'=>'Введите новый пароль'
        ]])->passwordInput() ?>

        <?= $form->field($model,'repeatnewpass',['inputOptions'=>[
            'placeholder'=>'Введите новый пароль ещё раз'
        ]])->passwordInput() ?>

        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-4">
                <?= Html::submitButton('Изменить',[
                    'class'=>'btn btn-primary'
                ]) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

