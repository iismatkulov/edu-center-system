<?php

use common\models\PaymentIncome;
use yii\grid\GridView;
use yii\helpers\Html;
$id = Yii::$app->request->get('id');
$pay = \common\models\Student::find()->where(['id' => $id])->one();

$this->title = 'Оплаты студента';
$this->params['breadcrumbs'][] = ['label' => $pay->fullName, 'url' => ['view', 'id' => $id]];
$this->params['breadcrumbs'][] = $this->title;


?>
<h1><?= Html::encode($this->title) ?></h1>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'created:datetime',
        [
            'attribute' => 'summa',
            'value' => function($data){
                return number_format($data->summa);
            }
        ],

        ['class' => 'yii\grid\ActionColumn','template' => ''],
    ],
]); ?>
