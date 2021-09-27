<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Вход в систему';
?>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="site-login">
            <div class="row text-center">
                <img src="<?= Yii::$app->request->baseUrl . '/' ?>logo.png">
                <h1><?= Html::encode($this->title) ?></h1>
            </div>

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div class="form-group">
                <?= Html::submitButton('Войти', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>
