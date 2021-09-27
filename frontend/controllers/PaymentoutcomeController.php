<?php

namespace frontend\controllers;

use common\models\PaymentIncome;
use Yii;
use common\models\PaymentOutcome;
use common\models\search\PaymentOutcomeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PaymentoutcomeController implements the CRUD actions for PaymentOutcome model.
 */
class PaymentoutcomeController extends Controller
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PaymentOutcome models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PaymentOutcomeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new PaymentOutcome();

        if ($model->load(Yii::$app->request->post())) {

            $model->created = time();
            $model->user_id = Yii::$app->user->id;
            $model->status = 0;

            if($model->save()){
                Yii::$app->getSession()->setFlash('success','Приход успешно сохранён!');
                return $this->refresh();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }
    public function actionSubcat() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $connection = Yii::$app->db;
                $sql = 'SELECT outcat.id as id, outcat.name as name  from glc_outlay_item outcat where outcat.outlay_id = '.$cat_id.' order by outcat.id Desc  ';
                $out = $connection->createCommand($sql)->queryAll();
                return ['output'=>$out, 'selected'=>''];
            }
        }
        return ['output'=>'', 'selected'=>''];
    }
    public function actionOutlay() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $connection = Yii::$app->db;
                $sql = 'SELECT outcat.id as id, outcat.name as name  from glc_outlay_item outcat where outcat.outlay_id = '.$cat_id.' order by outcat.id Desc  ';
                $out = $connection->createCommand($sql)->queryAll();
                return ['output'=>$out, 'selected'=>''];
            }
        }
        return ['output'=>'', 'selected'=>''];
    }

    /**
     * Displays a single PaymentOutcome model.
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


    public function actionReport()
    {
        $outlay = Yii::$app->request->post('outlay');
        $from = Yii::$app->request->post('from');
        $to = Yii::$app->request->post('to');
        $from = strtotime($from);
        $to = strtotime($to) + 86399;

        if(Yii::$app->request->post()){
            if(!empty($outlay)){
                $model = PaymentOutcome::find()->where(['between','created',$from,$to])->andWhere(['payment_method' => 0])->andWhere(['outlay_item' => $outlay])->orderBy(['created' => SORT_ASC])->all();
                $model1 = PaymentOutcome::find()->where(['between','created',$from,$to])->andWhere(['payment_method' => 1])->andWhere(['outlay_item' => $outlay])->orderBy(['created' => SORT_ASC])->all();
            }else{
                $model = PaymentOutcome::find()->where(['between','created',$from,$to])->andWhere(['payment_method' => 0])->orderBy(['created' => SORT_ASC])->all();
                $model1 = PaymentOutcome::find()->where(['between','created',$from,$to])->andWhere(['payment_method' => 1])->orderBy(['created' => SORT_ASC])->all();
            }
        } else{
                $model = PaymentOutcome::find()->where(['=','id',0])->orderBy(['id' => SORT_DESC])->all();

        }

        return $this->render('report', [
            'model' => $model,
            'model1' => $model1,
            'from' => $from,
            'to' => $to,
        ]);
    }

    /**
     * Creates a new PaymentOutcome model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PaymentOutcome();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PaymentOutcome model.
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
     * Deletes an existing PaymentOutcome model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PaymentOutcome model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PaymentOutcome the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PaymentOutcome::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
