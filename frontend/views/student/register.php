<?php

use dosamigos\datepicker\DatePicker;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Зарегистрировать студента';
$this->params['breadcrumbs'][] = $this->title;
$select = \common\models\Course::find()->orderBy(['start_time' => SORT_ASC])->all();
?>
<h1>
    <?=Html::encode($this->title)?>
</h1>
<div class="student-form">
    <hr>
    <h5><b>Информация о студенте</b></h5>
    <hr>
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <label>Дата добавления заявки</label>
            <input type="datetime-local" class="form-control" name="Student[created_at]">
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
            <?= $form->field($model, 'main_phone_number')
                    ->textInput(['maxlength' => true,'id' => 'phoneNumber1']) ?>
            <p>Шаблон телефон номера: +998 99 123 4444</p>
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
    <hr>
    <h5><b>Назначить на курсы</b></h5>
    <hr>
    <div class="row">
        <div class="col-md-3 form-group">
            <label>Курс №1</label>
            <select class="form-control" name="course1" id="course1"  onchange="selectService('course1')">
                <option>Выберите курс №1</option>
                <?php foreach ($select as $item) : ?>
                    <option value="<?=$item->id?>"><?=$item->name?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="col-md-3 form-group">
            <label>Курс №2</label>
            <select class="form-control" name="course2" id="course2"  onchange="selectService('course2')">
                <option>Выберите курс №2</option>
                <?php foreach ($select as $item) : ?>
                    <option value="<?=$item->id?>"><?=$item->name?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="col-md-3 form-group">
            <label>Курс №3</label>
            <select class="form-control" name="course3" id="course3"  onchange="selectService('course3')">
                <option>Выберите курс №3</option>
                <?php foreach ($select as $item) : ?>
                    <option value="<?=$item->id?>"><?=$item->name?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="col-md-3 form-group">
            <label>Курс №4</label>
            <select class="form-control" name="course4" id="course4" onchange="selectService('course4')">
                <option>Выберите курс №4</option>
                <?php foreach ($select as $item) : ?>
                    <option value="<?=$item->id?>"><?=$item->name?></option>
                <?php endforeach;?>
            </select>
        </div>
    </div>
    <hr>
    <h5><b>День оплаты</b></h5>
    <hr>
    <div class="row">
        <div class="col-md-6 form-group">
            <label>День оплаты</label>
            <input type="text" class="form-control" name="course_payday" placeholder="Введите день оплаты">
        </div>
        <div class="col-md-6 form-group">
            <label>Сумма оплаты</label>
            <input id="insumma" type="number" class="form-control" name="course_summa" placeholder="Введите сумму оплаты">
        </div>

    </div>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let totalInput =document.getElementById('insumma');
        totalInput.value =0;
    });


    function selectService(dataId) {
        let id = $(`#${dataId}`).val();
        $.get('http://glcmanager.uz/price/select?id=' + id.toString(), function (data) {
            console.log(data);
            let totalInput =document.getElementById('insumma');
            let total =  parseInt (totalInput.value) + parseInt(data.summa);
            totalInput.value=total;
        })
    }

</script>