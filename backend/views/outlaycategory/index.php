<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\OutlayCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории расхода';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outlay-category-index">
    <div class="row">
        <div class="col-md-10">
            <h1 style="margin-top: 0;"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-2">
            <p>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Добавить категорию
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
            'name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php $form = ActiveForm::begin(); ?>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавить категорию</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>