<?php

namespace backend\controllers;

use common\models\OutlayItem;
use Yii;
use common\models\OutlayCategory;
use common\models\search\OutlayCategorySearch;
use common\models\search\OutlayItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OutlaycategoryController implements the CRUD actions for OutlayCategory model.
 */
class OutlaycategoryController extends Controller
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
     * Lists all OutlayCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new OutlayCategory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $searchModel = new OutlayCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single OutlayCategory model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $outlay = new OutlayItem();
        if($outlay->load(Yii::$app->request->post())){
            $outlay->outlay_id = $id;
            if ($outlay->save()){
                Yii::$app->getSession()->setFlash('success','Расход успешно добавлен!');
                return $this->refresh();
            }
        }
        $searchModel = new OutlayItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['outlay_id' => $id]);
        return $this->render('view', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $this->findModel($id),
            'outlay' => $outlay,
        ]);
    }

    /**
     * Creates a new OutlayCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OutlayCategory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing OutlayCategory model.
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
     * Deletes an existing OutlayCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = OutlayItem::find()->where(['outlay_id' => $id])->all();
        foreach ($model as $item){
            $item->delete();
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    public function actionDeleteoutlay($id)
    {
        $model = OutlayItem::findOne($id);

        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the OutlayCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OutlayCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OutlayCategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
