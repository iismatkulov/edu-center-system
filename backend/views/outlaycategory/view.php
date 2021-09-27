<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\OutlayCategory */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Категории расходов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="outlay-category-view">
    <div class="row">
        <div class="col-md-9">
            <h1 style="margin-top: 0;"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-3 text-right">
            <p>
            <p>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Добавить расход
                </button>
            </p>

            </p>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'buttons'=>[
                    'delete'=>function ($url, $model) {
                        return Html::a('<span class="fa fa-trash"></span>', Url::to(['outlaycategory/deleteoutlay','id' => $model->id]));
                    },

                ],
            ],
        ],
    ]); ?>


</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php $form = ActiveForm::begin(); ?>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавить расход</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= $form->field($outlay, 'name')->textInput(['maxlength' => true]) ?>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>