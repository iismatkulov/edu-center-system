<?php

namespace frontend\controllers;

use Yii;
use common\models\PaymentIncome;
use common\models\search\PaymentIncomeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PaymentincomeController implements the CRUD actions for PaymentIncome model.
 */
class PaymentincomeController extends Controller
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
     * Lists all PaymentIncome models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PaymentIncomeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new PaymentIncome();

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
                $sql = 'SELECT student.id as id, CONCAT(student.first_name, \' \', student.last_name, \' \', student.middle_name,\' \',student.main_phone_number) as name from glc_student_courses course LEFT JOIN glc_student student ON student.id = course.student_id where course.course_id = '.$cat_id.' order by course.id Desc';
                $out = $connection->createCommand($sql)->queryAll();
                return ['output'=>$out, 'selected'=>''];
            }
        }
        return ['output'=>'', 'selected'=>''];
    }

    /**
     * Displays a single PaymentIncome model.
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
        $from = Yii::$app->request->post('from');
        $to = Yii::$app->request->post('to');
        $from = strtotime($from);
        $to = strtotime($to) + 86399;

        if(Yii::$app->request->post()){
            $model = PaymentIncome::find()->where(['between','created',$from,$to])->andWhere(['payment_method' => 0])->orderBy(['id' => SORT_DESC])->all();
            $model1 = PaymentIncome::find()->where(['between','created',$from,$to])->andWhere(['payment_method' => 1])->orderBy(['id' => SORT_DESC])->all();
        }else{
            $model = PaymentIncome::find()->where(['=','id',0])->orderBy(['id' => SORT_DESC])->all();
        }

        return $this->render('report', [
            'model' => $model,
            'model1' => $model1,
            'from' => $from,
            'to' => $to,
        ]);
    }

    /**
     * Creates a new PaymentIncome model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PaymentIncome();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PaymentIncome model.
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
     * Deletes an existing PaymentIncome model.
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
     * Finds the PaymentIncome model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PaymentIncome the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PaymentIncome::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
