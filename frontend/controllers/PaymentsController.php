<?php

namespace frontend\controllers;

use Cassandra\Date;
use common\models\PaymentIncome;
use DateInterval;
use DateTime;
use Yii;
use common\models\FuturePayment;
use common\models\search\FuturePaymentSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PaymentsController implements the CRUD actions for FuturePayment model.
 */
class PaymentsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                ],
            ],
        ];
    }

    /**
     * Lists all FuturePayment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FuturePaymentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['glc_future_payment.status' => 0]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }
    public function actionIndexdolg()
    {
        $searchModel = new FuturePaymentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['glc_future_payment.status' => 2]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }
    public function actionPart()
    {


        $searchModel = new FuturePaymentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['glc_future_payment.status' => 1]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }
    public function actionSendpart($id)
    {

        $model = FuturePayment::findOne($id);
        Yii::$app->playmobile->sendSms($model->student->main_phone_number, 'Оплата за обучение соврешена не полностью, просим вас доплатить. GLC');

    }
    public function actionSenddolg($id)
    {

        $model = FuturePayment::findOne($id);
        Yii::$app->playmobile->sendSms($model->student->main_phone_number, 'Оплатите задолженность за обучение. Администрация GLC');

    }

    public function actionToday(){
        $searchModel = new FuturePaymentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['glc_future_payment.pay_date' => strtotime(date('d-m-Y'))]);


        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }
    public function actionTomorrow(){
        $searchModel = new FuturePaymentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where('glc_future_payment.pay_date BETWEEN '.(strtotime(date('d-m-Y') ) + 86400).' AND '.(strtotime(date('d-m-Y') ) + 172799));

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }
    public function actionDay(){
        $searchModel = new FuturePaymentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where('glc_future_payment.pay_date BETWEEN '.(strtotime(date('d-m-Y') ) + 172800).' AND '.(strtotime(date('d-m-Y') ) + 259199));

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }
    public function actionDolg(){
        $searchModel = new FuturePaymentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['<','glc_future_payment.pay_date',strtotime(date('d-m-Y'))]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }


    public function actionRefresh(){

        return $this->redirect('index');
    }
    /**
     * Displays a single FuturePayment model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionStatus($id)
    {
        $model = $this->findModel($id);
        if($model->status == 0){
            $p_day = \common\models\StudentPayday::find()->where(['student_id' => $model->student_id])->andWhere(['created' => $model->created])->one();

            $day = date('d',$p_day->first_pay);
            $m = date('m',$model->pay_date);
            $y = date('Y',$model->pay_date);
            $m+=1;
            if ($m>12) {
                $y+=floor($m/12);
                $m=($m%12);

                if (!$m) {
                    $m=12;
                    $y--;
                }
            }

            while(true) {
                if (checkdate($m,$day,$y)){
                    break;
                }
                $day--;
            }

            $model->pay_date = strtotime(date($day.'-'.$m.'-'.$y));
            $model->update(false);

            $new = new PaymentIncome();

            $new->summa = $model->summa;
            $new->payment_method = Yii::$app->request->post('method');
            $new->created = time();
            $new->user_id = Yii::$app->user->id;
            $new->student_id = $model->student_id;
            $new->status = 0;
            $new->content = 'Полная оплата за студента '.$model->student->fullName;
            $new->save();
            return $this->redirect('index');

        }else{
            $new = new PaymentIncome();

            $new->summa = $model->summa;
            $new->payment_method = Yii::$app->request->post('method');
            $new->created = time();
            $new->user_id = Yii::$app->user->id;
            $new->student_id = $model->student_id;
            $new->status = 0;
            if($model->status == 2){
                $new->content = 'Оплата долга студента: '.$model->student->fullName;
            }else{
                $new->content = 'Оплата остатка от частичной оплаты студента: '.$model->student->fullName;
            }
            if($new->save(false)){
                $model->delete();
            }
            return $this->redirect('index');

        }

    }

    public function actionPay($id){

        if(Yii::$app->request->post()){
            $model = $this->findModel($id);
            $p_day = \common\models\StudentPayday::find()->where(['student_id' => $model->student_id])->andWhere(['created' => $model->created])->one();

            $day = date('d',$p_day->first_pay);
            $m = date('m',$model->pay_date);
            $y = date('Y',$model->pay_date);
            $m+=1;
            if ($m>12) {
                $y+=floor($m/12);
                $m=($m%12);

                if (!$m) {
                    $m=12;
                    $y--;
                }
            }

            while(true) {
                if (checkdate($m,$day,$y)){
                    break;
                }
                $day--;
            }

            $model->pay_date = strtotime(date($day.'-'.$m.'-'.$y));
            $model->update();

            $pay = new FuturePayment();
            $pay->pay_date = strtotime(\date('d-m-Y')) + 86400;
            $pay->summa = $model->summa - Yii::$app->request->post('sum');
            $pay->user_id = Yii::$app->user->id;
            $pay->created = time();
            $pay->student_id = $model->student_id;
            $pay->course_id = 1;
            $pay->status = 1;
            if($pay->save()){
                $new = new PaymentIncome();

                $new->summa = Yii::$app->request->post('sum');
                $new->payment_method = Yii::$app->request->post('method');
                $new->created = time();
                $new->user_id = Yii::$app->user->id;
                $new->student_id = $model->student_id;
                $new->status = 0;
                $new->content = 'Частичная оплата за студента: '.$model->student->fullName;
                $new->save(false);


                $day = date('d',$p_day->first_pay);
                $m = date('m',$model->pay_date);
                $y = date('Y',$model->pay_date);
                $m+=1;
                if ($m>12) {
                    $y+=floor($m/12);
                    $m=($m%12);

                    if (!$m) {
                        $m=12;
                        $y--;
                    }
                }

                while(true) {
                    if (checkdate($m,$day,$y)){
                        break;
                    }
                    $day--;
                }

                $model->pay_date = strtotime(date($day.'-'.$m.'-'.$y));


            }
        }
        return $this->redirect('part');
    }

    public function actionDolgtime($id){
        if(Yii::$app->request->post()){
            $model = $this->findModel($id);
            $p_day = \common\models\StudentPayday::find()->where(['student_id' => $model->student_id])->andWhere(['created' => $model->created])->one();

            $day = date('d',$p_day->first_pay);
            $m = date('m',$model->pay_date);
            $y = date('Y',$model->pay_date);
            $m+=1;
            if ($m>12) {
                $y+=floor($m/12);
                $m=($m%12);

                if (!$m) {
                    $m=12;
                    $y--;
                }
            }

            while(true) {
                if (checkdate($m,$day,$y)){
                    break;
                }
                $day--;
            }

            $model->pay_date = strtotime(date($day.'-'.$m.'-'.$y));
            $model->update();

            $pay = new FuturePayment();
            $pay->pay_date = strtotime(Yii::$app->request->post('date'));
            $pay->summa = $model->summa;
            $pay->user_id = Yii::$app->user->id;
            $pay->created = time();
            $pay->student_id = $model->student_id;
            $pay->course_id = 1;
            $pay->status = 2;
            $pay->save();

        }
        return $this->redirect('indexdolg');
    }

    /**
     * Creates a new FuturePayment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FuturePayment();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing FuturePayment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing FuturePayment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        if(Yii::$app->request->get('page')){
            return $this->redirect(['index','page' => Yii::$app->request->get(['page'])]);
        }else{
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the FuturePayment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FuturePayment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FuturePayment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
