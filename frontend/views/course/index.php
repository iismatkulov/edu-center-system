<?php

use common\models\Course;
use common\models\PaymentIncome;
use kartik\depdrop\DepDrop;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Курсы';
$this->params['breadcrumbs'][] = $this->title;
$req = Yii::$app->request;
if($req->post()){
    $connection = Yii::$app->db;
    $sql = 'SELECT teacher.fullname, course.name as subject, course_type.name 
        FROM glc_teacher teacher
        LEFT JOIN glc_subject course ON course.id = '.$req->post('subject').'
        LEFT JOIN glc_course_type course_type ON course_type.id = '.$req->post('type_id').'
        WHERE teacher.id = '.$req->post('teacher').'';
    $out = $connection->createCommand($sql)->queryAll();
}

?>
<style>
    @media print {
        #printableArea{
            display: block;
        }
    }
</style>
<h1><?= Html::encode($this->title) ?></h1>
<?php \yii\widgets\ActiveForm::begin()?>
<div class="row" style="margin-bottom: 40px">
    <div class="col-md-4">
        <?= Html::dropDownList('type_id', null,
            ArrayHelper::map(\common\models\CourseType::find()->all(), 'id', 'name'),
            ['id' => 'type_id','prompt' => 'Выбрать тип курсов...','class' => 'form-control'])
        ?>
    </div>
    <div class="col-md-4">
        <?php echo DepDrop::widget([
            'name' => 'subject',
            'options' => ['id'=>'subject_id'],
            'pluginOptions' => [
                'depends'  => ['type_id'],
                'placeholder' => 'Выбрать предмет ...',
                'url' => Url::to(['type'])
            ]
        ]);  ?>
    </div>
    <div class="col-md-3">
        <?php echo DepDrop::widget([
            'name' => 'teacher',
            'options' => ['id'=>'teacher_id'],
            'pluginOptions' => [
                'depends'  => ['type_id', 'subject_id'],
                'placeholder' => 'Выбрать учителя ...',
                'url' => Url::to(['course'])
            ]
        ]);  ?>
    </div>
    <div class="col-md-1">
        <?=Html::submitButton('Поиск',['class' => 'btn btn-success'])?>
    </div>
</div>

<?php \yii\widgets\ActiveForm::end();?>

<?php if(Yii::$app->request->post()) : ?>
<div class="row">
    <div class="col-md-10">
        <h4><?=$out[0]['name']?> <i class="fa fa-long-arrow-right"></i> <?=$out[0]['subject']?> <i class="fa fa-long-arrow-right"></i> <?=$out[0]['fullname']?></h4>
    </div>
    <div class="col-md-2">
        <button type="button" onclick="printDiv('printableArea')" class="btn btn-success noPrint"><i class="fa fa-print"></i> Печать</button>
    </div>
</div>
<?php endif;?>
<div>
    <table class="table table-bordered table-striped detail-view">
        <tr>
            <th>#</th>
            <th>Ф.И.О</th>
            <th>Номер телефона</th>
            <th>Время начала</th>
            <th>Действия</th>
        </tr>

        <?php $i = 0;  foreach ($course as $item) : ?>
        <?php $i++; ?>
        <tr>
            <td><?=$i?></td>
            <td><?=$item->student->fullName?></td>
            <td><?=$item->student->main_phone_number?></td>
            <td><?=$item->course->start_time?></td>
            <td>
                <?= Html::a('О студенте', ['student/view', 'id' => $item->student->id], ['class' => 'btn btn-primary']) ?>
            </td>
            <?php endforeach;?>
    </table>
</div>
<div id="printableArea" style="display: none">
    <div class="row">
        <div class="container">
            <h4 style="margin-left: 20px;"><?=$out[0]['name']?> <i class="fa fa-long-arrow-right"></i> <?=$out[0]['subject']?> <i class="fa fa-long-arrow-right"></i> <?=$out[0]['fullname']?></h4>
        </div>
    </div>
    <table class="table table-bordered table-striped detail-view">
        <tr>
            <th>#</th>
            <th>Ф.И.О</th>
            <th>Номер телефона</th>
            <th>Время начала</th>
        </tr>

        <?php $i = 0;  foreach ($course as $item) : ?>
        <?php $i++; ?>
        <tr>
            <td><?=$i?></td>
            <td><?=$item->student->fullName?></td>
            <td><?=$item->student->main_phone_number?></td>
            <td><?=$item->course->start_time?></td>
            <?php endforeach;?>
        </tr>
    </table>
</div>
