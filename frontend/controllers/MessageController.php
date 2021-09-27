<?php

namespace frontend\controllers;

use Cassandra\Date;
use common\models\PaymentIncome;
use DateInterval;
use DateTime;
use Yii;
use common\models\FuturePayment;
use common\models\search\FuturePaymentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PaymentsController implements the CRUD actions for FuturePayment model.
 */
class MessageController extends Controller
{
    public function actionIndexdolg($key)
    {
        if($key == '0b828484eb9e5b678b7684adcf543de8'){
            $model = FuturePayment::find()->where(['status' => 2])->andWhere(['pay_date' => strtotime(date('d-m-Y'))])->orderBy(['pay_date' => SORT_ASC])->all();
            $count = FuturePayment::find()->where(['status' => 2])->andWhere(['pay_date' => strtotime(date('d-m-Y'))])->orderBy(['pay_date' => SORT_ASC])->count();
//            foreach($model as $item){
//            Yii::$app->playmobile->sendSms($item->student->main_phone_number, 'Uvajaemiy student napominaem vam ob oplate dolga v razmere '.$item->summa.PHP_EOL.'GLC Center');
//            Yii::$app->playmobile->sendSms($item->student->main_phone_number, 'Оплатите задолженность за обучение.Администрация GLC');
//            }
            $message = 'Оплатите задолженность за обучение.Администрация GLC';
            $models = new \common\models\SmsReport();
            $models->created = time();
            $models->method = 0;
            $models->count = $count;
            if($models->save()){
                foreach ($model as $item){
                    $string=$item->student->main_phone_number;
                    $string = str_replace('(','',$string);
                    $string = str_replace(')','',$string);
                    $string = str_replace('+','',$string);
                    $string = str_replace(' ','',$string);
                    $string = str_replace('-','',$string);
                    $string=trim($string);
                    $count_string=strlen($string);
                    if($count_string==9){ $finished_number='998'.$string; }
                    if($count_string==12){$finished_number=$string; }

                    $new = new \common\models\ReportDetail();
                    $new->report_id = $models->id;
                    $new->created = time();
                    $new->phone = $finished_number;
                    $new->message = $message;
                    $new->save();
                }
            }

            return $this->render('index', [
                'model' => $model,
                'message' => $message,
            ]);
        }
    }

    public function actionToday($key){
        if($key == '0b828484eb9e5b678b7684adcf543de8') {
            $model = FuturePayment::find()->where(['pay_date' => strtotime(date('d-m-Y'))])->andWhere(['status' => 0])->orderBy(['pay_date' => SORT_ASC])->all();
            $count = FuturePayment::find()->where(['pay_date' => strtotime(date('d-m-Y'))])->andWhere(['status' => 0])->orderBy(['pay_date' => SORT_ASC])->count();
            //  foreach ($model as $item){
//            Yii::$app->playmobile->sendSms($item->student->main_phone_number, 'Istek srok vashey podpiski, prosim vnesti oplatu za obucheniye. S uvajeniyem administratsiya GLC');
            //  Yii::$app->playmobile->sendSms($item->student->main_phone_number, 'Истёк срок подписки просим внести оплату за обучение.Администрация GLC');
            // }
            $message = 'Истёк срок подписки.Просим внести оплату за обучение.Администрация GLC';
            $models = new \common\models\SmsReport();
            $models->created = time();
            $models->method = 1;
            $models->count = $count;
            if($models->save()){
                foreach ($model as $item){
                    $string=$item->student->main_phone_number;
                    $string = str_replace('(','',$string);
                    $string = str_replace(')','',$string);
                    $string = str_replace('+','',$string);
                    $string = str_replace(' ','',$string);
                    $string = str_replace('-','',$string);
                    $string=trim($string);
                    $count_string=strlen($string);
                    if($count_string==9){ $finished_number='998'.$string; }
                    if($count_string==12){$finished_number=$string; }

                    $new = new \common\models\ReportDetail();
                    $new->report_id = $models->id;
                    $new->created = time();
                    $new->phone = $finished_number;
                    $new->message = $message;
                    $new->save();
                }
            }

            return $this->render('index', [
                'model' => $model,
                'message' => $message,
            ]);
        }
    }
    public function actionDay($key){
        if($key == '0b828484eb9e5b678b7684adcf543de8') {

            $model = FuturePayment::find()->where('pay_date BETWEEN ' . (strtotime(date('d-m-Y')) + 172800) . ' AND ' . (strtotime(date('d-m-Y')) + 259199))->orderBy(['pay_date' => SORT_ASC])->all();
            $count = FuturePayment::find()->where('pay_date BETWEEN ' . (strtotime(date('d-m-Y')) + 172800) . ' AND ' . (strtotime(date('d-m-Y')) + 259199))->orderBy(['pay_date' => SORT_ASC])->count();
            //  foreach ($model as $item){
//            Yii::$app->playmobile->sendSms($item->student->main_phone_number, 'Do okonchaniya vashego platezha ostalos\' 2 dnya prosim vas sovershit\' oplatu bez zaderzhek. S uvajeniyem administratsiya GLC');
            //   Yii::$app->playmobile->sendSms($item->student->main_phone_number, 'Подписка истекает через 2 дня.Внесите оплату без задержек.Администрация GLC');
            // }
            $message = 'Подписка истекает через 2 дня.Внесите оплату без задержек.Администрация GLC';

            $models = new \common\models\SmsReport();
            $models->created = time();
            $models->method = 2;
            $models->count = $count;
            if($models->save()){
                foreach ($model as $item){
                    $string=$item->student->main_phone_number;
                    $string = str_replace('(','',$string);
                    $string = str_replace(')','',$string);
                    $string = str_replace('+','',$string);
                    $string = str_replace(' ','',$string);
                    $string = str_replace('-','',$string);
                    $string=trim($string);
                    $count_string=strlen($string);
                    if($count_string==9){ $finished_number='998'.$string; }
                    if($count_string==12){$finished_number=$string; }

                    $new = new \common\models\ReportDetail();
                    $new->report_id = $models->id;
                    $new->created = time();
                    $new->phone = $finished_number;
                    $new->message = $message;
                    $new->save();
                }
            }
            return $this->render('index', [
                'model' => $model,
                'message' => $message
            ]);
        }
    }
    public function actionDolg($key){
        if($key == '0b828484eb9e5b678b7684adcf543de8') {

            $model = FuturePayment::find()->where(['<', 'pay_date', strtotime(date('d-m-Y'))])->orderBy(['pay_date' => SORT_ASC])->all();
            $count = FuturePayment::find()->where(['<', 'pay_date', strtotime(date('d-m-Y'))])->orderBy(['pay_date' => SORT_ASC])->count();
            // foreach ($model as $item){
            //  Yii::$app->playmobile->sendSms($item->student->main_phone_number, 'Просрочена оплата за обучение, просим внести оплату.Администрация GLC');
            //}
            $message = 'Просрочена оплата за обучение, просим внести оплату.Администрация GLC';

            $models = new \common\models\SmsReport();
            $models->created = time();
            $models->method = 3;
            $models->count = $count;
            if($models->save()){
                foreach ($model as $item){
                    $string=$item->student->main_phone_number;
                    $string = str_replace('(','',$string);
                    $string = str_replace(')','',$string);
                    $string = str_replace('+','',$string);
                    $string = str_replace(' ','',$string);
                    $string = str_replace('-','',$string);
                    $string=trim($string);
                    $count_string=strlen($string);
                    if($count_string==9){ $finished_number='998'.$string; }
                    if($count_string==12){$finished_number=$string; }

                    $new = new \common\models\ReportDetail();
                    $new->report_id = $models->id;
                    $new->created = time();
                    $new->phone = $finished_number;
                    $new->message = $message;
                    $new->save();
                }
            }
            return $this->render('index', [
                'model' => $model,
                'message' => $message,
            ]);
        }
    }

    public function actionTest($key)
    {

        if($key == '0b828484eb9e5b678b7684adcf543de8'){
            Yii::$app->playmobile->sendSms('+998997783338', 'Тест смс-службы!');
            $model = new \common\models\SmsReport();
            $model->created = time();
            $model->method = 4;
            $model->count = 1;
            $model->save();
        }
    }

}